<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Auth;
class students extends Authenticatable
{
    protected $table = "students";
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public function checkRole($role)
    {
        if (Auth::guard('student')->user()->userRole->name == $role[0]) {
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
