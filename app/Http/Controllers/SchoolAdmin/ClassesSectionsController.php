<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\classesSectionsMapping;
use App\Models\sections;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;
class ClassesSectionsController extends Controller
{


    // Classes
    public function listClasses()
    {
        return view('schooladmin.classes-sections.classes.list');
    }

    public function addClass()
    {
        $teachers = User::where('school_id',auth()->user()->school_id)->where('role',env('TEACHER_ROLE_ID'))->get();
        $sections = sections::where('school_id',auth()->user()->school_id)->get();
        return view('schooladmin.classes-sections.classes.addOrEdit',compact('sections','teachers'));
    }

    public function editClass($id = "")
    {
        $teachers = User::where('school_id',auth()->user()->school_id)->where('role',env('TEACHER_ROLE_ID'))->get();
        $formData = classes::find($id);
        $sections = sections::where('school_id',auth()->user()->school_id)->get();
        return view('schooladmin.classes-sections.classes.addOrEdit',compact('formData','sections','teachers'));
    }

    public function classesListDatatable()
    {
        $classesAndsections = classes::where('school_id',auth()->user()->school_id)->orderBy('id','DESC')->get();
        return DataTables::of($classesAndsections)
        ->addIndexColumn()
        ->addColumn('actions', function ($class) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
            <a href="'.route('schooladmin.class-sections.class.edit',["id" => $class->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->addColumn('sections', function ($class) {
            $returnData = "";
            foreach($class->sections as $section)
            {
                $returnData .= $section->name."<br>";
            }
            return $returnData;
        })
        ->rawColumns(['actions','sections'])
        ->make(true);
    }

    public function addOrEditClassSubmit(Request $request, $id = "")
    {
        $validators = [
            'name' => ['required', Rule::unique('classes')->where(function ($query) {
                return $query->where('school_id', auth()->user()->school_id);
            })]
        ];
        if ($id != "") $validators['name'] = 'required';
        $validator = Validator::make($request->all(), $validators);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {

            $newClass = $id != "" ? classes::find($id) : new classes;
            $newClass->name = isset($request->name) ? $request->name : "";
            $newClass->tution_fee = isset($request->tution_fee) ? (int) $request->tution_fee : "";
            $newClass->school_id = auth()->user()->school_id;
            $newClass->save();
            $sections_present = [];
            for($i = 0; $i < count($request->section); $i++)
            {
                // return $request->section[$i];
                $newMap = $id != "" ? (classesSectionsMapping::where('class_id',$newClass->id)->where('school_id',auth()->user()->school_id)->where('section_id',$request->section[$i])->first() ? classesSectionsMapping::where('class_id',$newClass->id)->where('school_id',auth()->user()->school_id)->where('section_id',$request->section[$i])->first() : new classesSectionsMapping) : new classesSectionsMapping;
                $newMap->class_id = $id != "" ? $id : $newClass->id;
                $newMap->school_id = auth()->user()->school_id;
                $newMap->section_id = isset($request->section[$i]) ? $request->section[$i] : '';
                $newMap->max_strength = isset($request->max_strength[$i]) ? $request->max_strength[$i] : '';
                $newMap->class_teacher_id = isset($request->teacher[$i]) ? $request->teacher[$i] : '';
                $newMap->save();
                array_push($sections_present,$newMap->id);
            }
            if ($id != "") classesSectionsMapping::where('class_id',$newClass->id)->where('school_id',auth()->user()->school_id)->whereNotIn('id',$sections_present)->delete();
            if ($id != "") return response()->json(['success' => "Successfully updated"], 200);
            return response()->json(['success' => "Successfully created"], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // Duplicate entry error
                preg_match('/for key \'(.*?)\'/', $e->getMessage(), $matches);
                $keyName = $matches[1];
                $fieldName = str_replace('_unique', '', $keyName);
                return response()->json(['error' => "{$fieldName} already exists."], 400);
            } else {
                // Handle other types of errors
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }
    }


    // sections
    public function listSections()
    {
        return view('schooladmin.classes-sections.sections.list');
    }

    public function addSection()
    {
        return view('schooladmin.classes-sections.sections.addOrEdit');
    }

    public function editSection($id = "")
    {
        $formData = sections::find($id);
        return view('schooladmin.classes-sections.sections.addOrEdit',compact('formData'));
    }

    public function addOrEditSectionSubmit(Request $request, $id = "")
    {
        $validators = [
            'name' => ['required', Rule::unique('sections')->where(function ($query) {
                return $query->where('school_id', auth()->user()->school_id);
            })]
        ];
        if ($id != "") $validators['name'] = 'required';
        $validator = Validator::make($request->all(), $validators);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {

            $newClass = $id != "" ? sections::find($id) : new sections;
            $newClass->name = isset($request->name) ? $request->name : "";
            $newClass->school_id = auth()->user()->school_id;
            $newClass->save();

            if ($id != "") return response()->json(['success' => "Successfully updated"], 200);
            return response()->json(['success' => "Successfully created"], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // Duplicate entry error
                preg_match('/for key \'(.*?)\'/', $e->getMessage(), $matches);
                $keyName = $matches[1];
                $fieldName = str_replace('_unique', '', $keyName);
                return response()->json(['error' => "{$fieldName} already exists."], 400);
            } else {
                // Handle other types of errors
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }
    }

    public function sectionsListDatatable()
    {
        $students = sections::where('school_id',auth()->user()->school_id)->orderBy('id','DESC')->get();
        return DataTables::of($students)
        ->addIndexColumn()
        ->addColumn('actions', function ($student) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
            <a href="'.route('schooladmin.class-sections.section.edit',["id" => $student->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->rawColumns(['actions'])
        ->make(true);
    }
}
