<?php
namespace App\Traits;

use App\Models\days;
use App\Models\periods;
use App\Models\TimeTable;
use Exception;

trait GetTImeTable
{
    function getTimeTableByclassAndSectionDataTable($class,$section) {
        $days = days::where('id', '!=', 1)->get();
        $periods = periods::select('id','period_name','from','to')->where('school_id', auth()->user()->school_id)->get();
        $timeTable = TimeTable::select('time_tables.id','time_tables.school_id','time_tables.day_id','time_tables.class_id','time_tables.section_id','time_tables.period_id','time_tables.subject_id','time_tables.subject_id','users.name as staff_name','users.id','subjects.id','subjects.subject_name','periods.id','periods.period_name','periods.from','periods.to')->where('time_tables.school_id', auth()->user()->school_id)->where('time_tables.class_id', $class)->where('time_tables.section_id', $section)
        ->join('users','time_tables.staff_id','=','users.id')
        ->join('subjects','time_tables.subject_id','=','subjects.id')
        ->join('periods','time_tables.period_id','=','periods.id');
        // return $timeTable->where('day_id',3);
        $data = [];
        foreach($days as $day)
        {
            $newObj = [];
            $newObj['day'] = $day->name;
            foreach($periods as $period)
            {
                $queryClone = clone $timeTable;
                $mydata = $queryClone->where('time_tables.day_id',$day->id)->where('time_tables.period_id',$period->id)->first();
                $newObj[$period->period_name] = $mydata !== null ? $mydata->subject_name.' <br> '.$mydata->staff_name : '---';
            }
            $data[] = $newObj;
        }
        return $data;
    }
}
