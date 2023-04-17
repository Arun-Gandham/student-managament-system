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

}
