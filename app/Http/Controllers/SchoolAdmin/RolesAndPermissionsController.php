<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\permissionModule;
use App\Models\RolePermissions;
use App\Models\Roles;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RolesAndPermissionsController extends Controller
{
    public function rolesList()
    {
        return view('SchoolAdmin.roles-permissions.list');
    }

    public function rolesListDatatable()
    {
        $roles = Roles::whereNotIn("id",[1,2])->whereIn('school_id',[0,Auth::user()->school_id])->select('roles.*')->get();
        return DataTables::of($roles)
        ->addIndexColumn()
        ->addColumn('actions', function ($role) {
            $reurnButtons = '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>';
            if($role->school_id == 0) return $reurnButtons; // removing edit option for default roles
            $reurnButtons .='<a href="'.route('schooladmin.roles-permissions.roles.edit',["id" => $role->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
            return $reurnButtons;
        })
        ->addColumn('description', function ($role) {
            return strlen($role->description) > 110 ? substr($role->description, 0, 110) . "..." : $role->description;
        })
        ->addColumn('status', function ($role) {
            return $role->status == 1 ? "Yes" : "No";
        })
        ->rawColumns(['actions','status'])
        ->make(true);
    }

    public function addRole()
    {
        return view('SchoolAdmin.roles-permissions.addAndEditRole');
    }

    public function editRole(Request $request,$id = "")
    {
        $formData = Roles::where("id",$id)->where("school_id",Auth::user()->school_id)->select('roles.*')->first();
        return view('SchoolAdmin.roles-permissions.addAndEditRole',compact('formData'));
    }

    public function addOrUpdateSubmit(Request $request,$id = "")
    {
        $validator = Validator::make($request->all(), ['name' => [ 'required',
        function ($attribute, $value, $fail) {
            $exists = Roles::where('name', $value)->where('school_id',Auth::user()->school_id)->exists();
            if ($exists) {
                $fail($value.' role already registered.');
            }
        },
        ]]);

        if ($validator->fails() && $id == "") {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{

            $newRole = $id != "" ? Roles::find($id): new Roles;
            $newRole->name = $request->name;
            $newRole->description = $request->description;
            $newRole->status = (int) $request->status;
            $newRole->school_id = Auth::user()->school_id;
            $newRole->save();
            if($id != "") return response()->json(['success'=>"Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }

    }

    public function permissions($id = "")
    {
        $rolesWithPermissions = $id != "" ? permissionModule::get() : [];
        $roles = Roles::whereNotIn('id',[1,2,4,5])->whereIn('school_id',[0,Auth::user()->school_id])->get();
        return view('SchoolAdmin.roles-permissions.permissions',compact('roles',"id","rolesWithPermissions"));
    }

    public function permissionsSubmit(Request $request,$role_id)
    {
        try{
            $modules = permissionModule::get();
            foreach($modules as $module)
            {
                $RolePermision = RolePermissions::where('module_id', $module->id)->where('school_id', Auth::user()->school_id)->where('role_id', $role_id)->first();
                if ($RolePermision) {
                    // Update existing record
                    $RolePermision->is_view = $request->has('view_'.$module->id) ? 1 : 0;
                    $RolePermision->is_add = $request->has('add_'.$module->id) ? 1 : 0;
                    $RolePermision->is_edit = $request->has('edit_'.$module->id) ? 1 : 0;
                    $RolePermision->is_delete = $request->has('delete_'.$module->id) ? 1 : 0;
                    $RolePermision->save();
                } else {
                    // Create new record
                    $newPermission = new RolePermissions;
                    $newPermission->role_id = $role_id;
                    $newPermission->school_id = Auth::user()->school_id;
                    $newPermission->module_id = $module->id;
                    $newPermission->is_view = $request->has('view_'.$module->id) ? 1 : 0;
                    $newPermission->is_add = $request->has('add_'.$module->id) ? 1 : 0;
                    $newPermission->is_edit = $request->has('edit_'.$module->id) ? 1 : 0;
                    $newPermission->is_delete = $request->has('delete_'.$module->id) ? 1 : 0;
                    $newPermission->save();
                }
            }
            return response()->json(['success'=>"Completed Successfully"],200);
        }
        catch(Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
}
