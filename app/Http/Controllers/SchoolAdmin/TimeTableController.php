<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\classes;
use App\Models\classesSectionsMapping;
use App\Models\days;
use App\Models\periods;
use App\Models\sections;
use App\Models\subjects;
use App\Models\TimeTable;
use App\Models\User;
use App\Traits\GetTImeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimeTableController extends Controller
{
    use GetTImeTable;

    public function showTimeTable($class = "", $section = "")
    {
        $classes = classes::where('school_id', auth()->user()->school_id)->get();
        return view('SchoolAdmin.time-table.showTimeTable', compact('classes'));
    }

    public function timeTableManage($class = "", $section = "")
    {
        $showTable = ($class != "" && $section != "") ? 1 : 0;
        $staff = User::where('school_id', auth()->user()->school_id)->where('role', '!=', env('SCHOOL_ADMIN_ROLE_ID'))->get();
        $subjects = subjects::where('school_id', auth()->user()->school_id)->get();
        $periods = periods::where('school_id', auth()->user()->school_id)->get();
        $days = days::where('id', '!=', 1)->get();
        $sections = classesSectionsMapping::where('classes_sections_mapping.class_id',$class)->where('classes_sections_mapping.school_id', auth()->user()->school_id)
        ->join('sections','sections.id','=','classes_sections_mapping.section_id')
        ->get() ?? [];
        $modifiedTable = [];
        $finalTimeTable = [];
        $timeTable = TimeTable::where('school_id', auth()->user()->school_id)->where('class_id', $class)->where('section_id', $section)->get();
        foreach ($timeTable as $each) {
            $modifiedTable[$each->day_id][] = $each;
        }
        foreach ($modifiedTable as $day => $period) {
            $newperioData = [];
            foreach ($period as $eachPeriod) {
                $newperioData[$eachPeriod->period_id] = $eachPeriod;
            }
            $finalTimeTable[$day] = $newperioData;
        }
        $classes = classes::where('school_id', auth()->user()->school_id)->get();
        return view('SchoolAdmin.time-table.addOrEditTImeTable', compact('classes', 'finalTimeTable', 'showTable', 'staff', 'subjects', 'days', 'periods', 'sections'));
    }

    public function addPeriod()
    {
        $periods = periods::where('school_id', auth()->user()->school_id)->get();
        return view('SchoolAdmin.time-table.addOrEditPeriods', compact('periods'));
    }

    public function addOrEditSubmitPeriod(Request $request, $id = "")
    {
        $validators = [
            'period_name' => 'required',
            'from' => 'required',
            'to' => 'required|after:from',
        ];
        $validator = Validator::make($request->all(), $validators);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $newPeriod = $id != "" ? periods::where('school_id', auth()->user()->school_id)->where('id', $id)->first() : new periods;
            if ($id == "") $newPeriod->school_id = auth()->user()->school_id;
            $newPeriod->period_name = isset($request->period_name) ? $request->period_name : "";
            $newPeriod->from = isset($request->from) ? $request->from : "";
            $newPeriod->to = isset($request->to) ? $request->to : "";
            $newPeriod->save();
            return redirect()->route('schooladmin.time-table.addPeriod');
        } catch (\Illuminate\Database\QueryException $e) {
            return "something went wrong please contact admin";
        }
    }

    public function editPeriod($id)
    {
        $formData = periods::find($id);
        $periods = periods::where('school_id', auth()->user()->school_id)->get();
        return view('SchoolAdmin.time-table.addOrEditPeriods', compact('periods', 'formData'));
    }

    public function getTimeTable(Request $request)
    {
        $data = $this->getTimeTableByclassAndSectionDataTable($request->class,$request->section);
        $title = classes::find($request->class)->name." - ".sections::find($request->section)->name.' Time Table';
        return response()->json(['data' => $data,'title' => $title,'class' => $request->class,'section' => $request->section], 200);
    }

    public function submitTimeTable(Request $request)
    {
        for ($i = 0; $i < count($request->period_id); $i++) {
            $period = TimeTable::where('school_id', auth()->user()->school_id)->where('period_id', $request->period_id[$i])->where('section_id', $request->section_id)->where('class_id', $request->class_id)->where('day_id', $request->day_id[$i]);
            if ($request->subject_id[$i] == null || $request->staff_id[$i] == null) {
                if ($period->exists()) {
                    $period->delete();
                }
                continue;
            }
            $newPeriod = $period->exists() ? $period->first() : new TimeTable;
            $newPeriod->school_id = auth()->user()->school_id;
            $newPeriod->period_id = $request->period_id[$i];
            $newPeriod->day_id = $request->day_id[$i];
            $newPeriod->subject_id = $request->subject_id[$i];
            $newPeriod->staff_id = $request->staff_id[$i];
            $newPeriod->class_id = $request->class_id;
            $newPeriod->section_id = $request->section_id;
            $newPeriod->save();
        }
        return response()->json(['success' => "Successfully Saved"], 200);
    }
}
