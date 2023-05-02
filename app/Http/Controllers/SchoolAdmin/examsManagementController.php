<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\classesSectionsMapping;
use App\Models\examResults;
use App\Models\examsSchedule;
use App\Models\sections;
use App\Models\students;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class examsManagementController extends Controller
{

    public function scheduleExam()
    {
        $classes = classes::where('school_id', auth()->user()->school_id)->get();
        return view('schooladmin.exams.addOrEdit', compact('classes'));
    }

    public function scheduleExamEdit($id)
    {
        $formData = examsSchedule::find($id);
        $sections = classesSectionsMapping::where('classes_sections_mapping.class_id', $formData->class_id)->where('classes_sections_mapping.school_id', auth()->user()->school_id)
            ->join('sections', 'sections.id', '=', 'classes_sections_mapping.section_id')
            ->get() ?? [];
        $classes = classes::where('school_id', auth()->user()->school_id)->get();
        return view('schooladmin.exams.addOrEdit', compact('classes', 'formData', 'sections'));
    }

    public function scheduleExamSubmit(Request $request, $id = "")
    {
        $validators = [
            'exam_name' => 'required',
            'total_marks' => 'required',
            'class' => 'required',
            'section' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'topics' => 'required',
            'student_show' => 'required',
            'mode' => 'required'
        ];
        $validator = Validator::make($request->all(), $validators);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $newExam = $id != "" ? examsSchedule::find($id) : new examsSchedule;
            $newExam->name = $request->exam_name;
            $newExam->total_marks = $request->total_marks;
            $newExam->school_id = auth()->user()->school_id;
            $newExam->class_id = $request->class;
            $newExam->section_id = $request->section;
            $newExam->start_date = $request->start_date;
            $newExam->end_date = $request->end_date;
            $newExam->is_result_released = $request->result_released;
            $newExam->topics = $request->topics;
            $newExam->status = $request->student_show;
            $newExam->mode = $request->mode;
            $newExam->save();
            if ($id != "") return response()->json(['success' => "Successfully updated"], 200);
            return response()->json(['success' => "Successfully created"], 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function examList()
    {
        return view('schooladmin.exams.list');
    }

    public function examsListDatatable()
    {
        $exams = examsSchedule::where('exams_schedules.school_id', auth()->user()->school_id)
            ->join('sections', 'exams_schedules.section_id', '=', 'sections.id')
            ->join('classes', 'exams_schedules.class_id', '=', 'classes.id')
            ->select('exams_schedules.*', 'classes.name as class_name', 'sections.name as section_name')
            ->orderBy('id', 'DESC')
            ->get();
        return DataTables::of($exams)
            ->addIndexColumn()
            ->addColumn('mode', function ($exam) {
                return $exam->mode ? 'Offline' : "Online";
            })
            ->addColumn('is_result_released', function ($exam) {
                return $exam->is_result_released == 1 ? 'Yes' : "No";
            })
            ->addColumn('actions', function ($exam) {
                $reurnButtons = '<a href="" class="btn btn-xs btn-primary"><img src="' . asset("svg/eye.svg") . '" atl="view"></a>
            <a href="' . route('schooladmin.exams.schedule.edit', ["id" => $exam->id]) . '" class="btn btn-xs btn-info"><img src="' . asset("svg/edit.svg") . '" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="' . asset("svg/trash.svg") . '" atl="delete"></button>
                    </form>';
                return $reurnButtons;
            })
            ->rawColumns(['actions', 'mode'])
            ->make(true);
    }

    public function examResultsUpdate($id)
    {
        $examDetails = examsSchedule::find($id);
        $students = students::where('school_id', auth()->user()->school_id)->where('class_id', $examDetails->class_id)->where('section_id', $examDetails->section_id)
            ->leftjoin('exam_results', function ($join) use ($examDetails) {
                $join->on('exam_results.student_id', '=', 'students.id')
                    ->where('exam_results.exam_id', '=', $examDetails->id);
            })
            ->select('students.id', 'students.first_name', 'students.last_name', 'students.sur_name', 'students.roll_no', 'exam_results.marks')
            ->get();
        return view('schooladmin.exams.updateResults', compact('students', 'examDetails'));
    }

    public function examResultsUpdateSubmit(Request $request, $id)
    {
        try {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data = [
                    'marks' => $request->marks[$i],
                    'student_id' => $request->student_id[$i],
                    'exam_id' => $request->exam_id
                ];
                examResults::updateOrInsert(['student_id' => $request->student_id[$i], 'exam_id' => $request->exam_id], $data);
            }
            return response()->json(['success' => "Successfully Updated"], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
