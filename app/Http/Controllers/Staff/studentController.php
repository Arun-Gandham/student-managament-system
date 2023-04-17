<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Parents;
use App\Models\StudentAddress;
use App\Models\students;
use App\Traits\FileHandling;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class studentController extends Controller
{
    use FileHandling;

    // Student module start
    public function studentList()
    {
        return view('Staff.student.list');
    }

    public function StudentsListDatatable()
    {
        $students = students::where('school_id',auth()->user()->school_id)->select('*')->get();
        return DataTables::of($students)
        ->addIndexColumn()
        ->addColumn('actions', function ($student) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
            <a href="'.route('staff.student.edit',["id" => $student->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->addColumn('name', function ($student) {
            return $student->first_name.''.$student->last_name.' '.$student->sur_name;
        })
        ->addColumn('gender', function ($student) {
            if($student->gender == 1) return "Male";
            if($student->gender == 2) return "Female";
            return "Other";
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function addStudent($id = "")
    {
        $genders = Gender::get();
        return view('Staff.student.addOrEditStudent',compact('genders','id'));
    }
    public function editStudent($id = "")
    {
        $addressData = StudentAddress::where('student_id',$id)->first();
        $formData = students::find($id);
        $parentData = Parents::where('student_id',$id)->first();
        $genders = Gender::get();
        return view('Staff.student.addOrEditStudent',compact('genders','id','formData','parentData','addressData'));
    }


    public function addOrEditStudentSubmit(Request $request, $id = "")
    {
        $validators = [
            'first_name' => 'required',
            'sur_name' => 'required',
            'registration_number' => ['required',Rule::unique('students')->where(function ($query) {
                return $query->where('school_id', auth()->user()->school_id);
            })],
            'dob' => 'required',
            'gender' => 'required',
            'primary_name' => 'required',
            'primary_phone_number' => 'required',
            'primary_relation' => 'required',
        ];
        if($id != "") $validators['registration_number'] = 'required';
        $messages = [
            'first_name.required' => 'First Name field is required.',
            'sur_name.required' => 'Sur Name field is required.',
            'registration_number.required' => 'Registration Number field is required.',
            'registration_number.unique' => 'Registration Number already exists.',
            'dob.required' => 'Date of birth field is required.',
            'gender.required' => 'Gender field is required.',
            'primary_name.required' => 'Person 1 name is required.',
            'primary_phone_number.required' => 'Person 1 phone number is required.',
            'primary_relation.required' => 'Person 1 relation is required.',
        ];
        $validator = Validator::make($request->all(), $validators, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{

            $newStudent = $id != "" ? students::find($id): new students;
            $newStudent->first_name = isset($request->first_name) ? $request->first_name : "";
            $newStudent->last_name =  isset($request->last_name) ? $request->last_name : "";
            $newStudent->sur_name =  isset($request->sur_name) ? $request->sur_name : "";
            $newStudent->registration_number =  isset($request->registration_number) ? $request->registration_number : "";
            $newStudent->dob =  isset($request->dob) ? $request->dob : "";
            $newStudent->gender =  isset($request->gender) ? $request->gender : "";
            $newStudent->email =  isset($request->email) ? $request->email : "";
            $newStudent->phone =  isset($request->phone) ? $request->phone : "";
            $newStudent->password =  Hash::make($request->registration_number);

            if($id == "")
            {
                $newStudent->school_id = auth()->user()->school_id;
                $newStudent->role = env('STUDENT_ROLE_ID');
            }
            if(isset($request->profile_photo))
            {
                $schoolId = auth()->user()->school_id;
                if(isset($request->profile_photo))
                {
                    if ($id != "" && File::exists($newStudent->profile_photo)) {
                        File::delete($newStudent->profile_photo);
                    }
                    $newStudent->profile_photo = isset($request->profile_photo) ? $this->upload($request->profile_photo,"uploads/schools/".$schoolId."/".env('STUDENT_IMAGE_PATH'),time()) : '';
                }
            }
            $newStudent->save();

            $newParent = $id != "" ? Parents::where('student_id',$id)->first(): new Parents;
            $newParent->student_id = $newStudent->id;
            $newParent->school_id = auth()->user()->school_id;
            $newParent->student_registration_number =  isset($request->registration_number) ? $request->registration_number : "";
            if($id == "") $newParent->password =  Hash::make($request->registration_number);

            $newParent->primary_name = isset($request->primary_name) ? $request->primary_name : "";
            $newParent->primary_phone = isset($request->primary_phone_number) ? $request->primary_phone_number : "";
            $newParent->primary_alt_phone = isset($request->primary_alt_phone_number) ? $request->primary_alt_phone_number : "";
            $newParent->primary_email = isset($request->primary_email) ? $request->primary_email : "";
            $newParent->primary_education = isset($request->primary_education) ? $request->primary_education : "";
            $newParent->primary_ocupation = isset($request->primary_ocupdation) ? $request->primary_ocupdation : "";
            $newParent->primary_relation = isset($request->primary_relation) ? $request->primary_relation : "";

            $newParent->secondary_name = isset($request->secondary_name) ? $request->secondary_name : "";
            $newParent->secondary_phone = isset($request->secondary_phone_number) ? $request->secondary_phone_number : "";
            $newParent->secondary_alt_phone = isset($request->secondary_alt_phone_number) ? $request->secondary_alt_phone_number : "";
            $newParent->secondary_email = isset($request->secondary_email) ? $request->secondary_email : "";
            $newParent->secondary_education = isset($request->secondary_education) ? $request->secondary_education : "";
            $newParent->secondary_ocupation = isset($request->secondary_ocupation) ? $request->secondary_ocupation : "";
            $newParent->secondary_relation = isset($request->secondaty_relation) ? $request->secondaty_relation : "";
            $newParent->save();

            $newAddress = $id != "" ? StudentAddress::where('student_id',$id)->first(): new StudentAddress;
            if($id == "") $newAddress->student_id = $newStudent->id;
            $newAddress->d_no = isset($request->d_no) ? $request->d_no : "";
            $newAddress->street = isset($request->street) ? $request->street : "";
            $newAddress->city = isset($request->city) ? $request->city : "";
            $newAddress->district = isset($request->district) ? $request->district : "";
            $newAddress->state = isset($request->state) ? $request->state : "";
            $newAddress->pincode = isset($request->pincode) ? $request->pincode : "";
            $newAddress->save();

            if($id != "") return response()->json(['success'=>"Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
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

    // student mdoule end

    public function rolesList()
    {
        return view('Staff.student.list');
    }


}
