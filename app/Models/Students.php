<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class students extends Authenticatable
{
    protected $table = "students";
    use HasFactory;

    public function checkRole($role)
    {
        if (auth()->guard('student')->user()->userRole->name == $role[0]) {
            return true;
        }

        return false;
    }

    public function userRole()
    {
        return $this->hasOne(Roles::class, 'id', 'role');
    }

    public function schoolData()
    {
        return $this->hasOne(Schools::class, 'id', 'school_id');
    }

    public function getClass()
    {
        return $this->hasOne(classes::class, 'id', 'class_id');
    }

    public function getSection()
    {
        return $this->hasOne(sections::class, 'id', 'section_id');
    }

    public function getAttendanceByData($date = "")
    {
        return $this->hasOne(studentAttendance::class,'student_id','id')->where('date',$date);
    }

    public function getTutionFee()
    {
        return $this->hasOne(studentFee::class,'student_id','id')->where('academic_id',masterSettings::find(1)->current_academic_year_id);
    }
}
