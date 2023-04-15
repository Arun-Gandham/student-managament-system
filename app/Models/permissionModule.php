<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class permissionModule extends Model
{
    use HasFactory;
    protected $table = "permission_module";

    public function role_permissions($roleId = "")
    {
        return $this->hasMany(RolePermissions::class, 'module_id', 'id')->where("school_id",Auth::user()->school_id)->where("role_id",$roleId);
    }
}
