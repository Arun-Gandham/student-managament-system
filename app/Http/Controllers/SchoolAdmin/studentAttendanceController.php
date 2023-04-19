<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\attendanceTypes;
use App\Models\classes;
use App\Models\studentAttendance;
use App\Models\students;
use Illuminate\Http\Request;
use DataTables;
use DB;

class studentAttendanceController extends Controller
{
    public function markAttendance()
    {
        $classes = classes::where('school_id', auth()->user()->school_id)->get();
        return view('SchoolAdmin.studentAttendance.mark', compact('classes'));
    }

    // get sections by class Id
    public function getSections(Request $request)
    {
        $options = classes::where('id', $request->selectedOption)->where('school_id', auth()->user()->school_id)->first()->sections->pluck('name', 'id')
            ->toArray();
        return response()->json(['options' => $options]);
    }

    public function getStudentsForAttendance(Request $request)
    {
        $attendanceTypes = attendanceTypes::pluck('id', 'name')->toArray();
        $students = students::where('school_id', auth()->user()->school_id)->where('class_id', $request->class)->where('section_id', $request->section)->select('id', 'roll_no', 'first_name', 'last_name', 'sur_name')->get();
        return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('name', function ($student) {
                return $student->first_name . ' ' . $student->last_name . ' ' . $student->sur_name;
            })
            ->addColumn('actions', function ($student) use ($attendanceTypes, $request) {
                $attendance = $student->getAttendanceByData($request->date)->first();
                $attendance = isset($attendance) && $attendance->status_id ? $attendance->status_id : '';
                $returnData = "<input type='hidden' name='studen_id[]' value='" . $student->id . "' name='student_id[]'><select class='form-control' name='status[]'>";
                foreach ($attendanceTypes as $name => $id) {
                    $isSelceted = $attendance == $id ? 'selected' : '';
                    $returnData .= "<option value='" . $id . "' " . $isSelceted . ">" . $name . "</option>";
                }
                $returnData .= "</select>";
                return $returnData;
            })
            ->addColumn('attendance', function ($student) use ($request) {
                $data = $student->getAttendanceByData($request->date)->first();
                return isset($data->status_id) ? $data->status_id : 0;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function attendanceBulkUpdate(Request $request)
    {
        for ($i = 0; $i < count($request->studen_id); $i++) {
            $attendance_object = studentAttendance::where(['student_id' => $request->studen_id[$i], 'date' => $request->selected_date]);
            $attendance = $attendance_object->exists() ? $attendance_object->first() : new studentAttendance;
            $attendance->student_id = $request->studen_id[$i];
            $attendance->date = $request->selected_date;
            $attendance->status_id = $request->status[$i];
            $attendance->save();
        }
        return response()->json(['success' => "Successfully created"], 201);
    }
}
