<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\states;
use App\Models\User;
use App\Models\userAddress;
use App\Traits\FileHandling;
use App\Traits\StrongPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use File;

class StaffManagementController extends Controller
{
    use StrongPassword;
    use FileHandling;

    public function staffList()
    {
        // return $roles = User::whereNotIn("role",[env('SUPER_ADMIN_ROLE_ID'),env('SCHOOL_ADMIN_ROLE_ID'),env('STUDENT_ROLE_ID'),env('PARENT_ROLE_ID')])->where('school_id',Auth::user()->school_id)->select('*')->get();
        return view('SchoolAdmin.staff.list');
    }

    public function staffListDatatable()
    {
        $roles = User::whereNotIn("role",[env('SUPER_ADMIN_ROLE_ID'),env('SCHOOL_ADMIN_ROLE_ID'),env('STUDENT_ROLE_ID'),env('PARENT_ROLE_ID')])->where('school_id',Auth::user()->school_id)->select('*')->get();
        return DataTables::of($roles)
        ->addIndexColumn()
        ->addColumn('role_name', function ($user) {
            return $user->userRole->name ?? "No Role Assigned";
        })
        ->addColumn('actions', function ($role) {
            $reurnButtons = '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>';
            if($role->school_id == 0) return $reurnButtons; // removing edit option for default roles
            $reurnButtons .='<a href="'.route('schooladmin.staff-management.edit',["id" => $role->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
            return $reurnButtons;
        })
        ->rawColumns(['actions','status'])
        ->make(true);
    }

    public function addStaff()
    {
        $roles = Roles::whereIn('school_id',[0,Auth::user()->school_id])->whereNotIn('id',[env('SUPER_ADMIN_ROLE_ID'),env('SCHOOL_ADMIN_ROLE_ID'),env('STUDENT_ROLE_ID'),env('PARENT_ROLE_ID')])->where('status',1)->select('name','id')->get();
        $strong_password = $this->generatePassword();
        $states = states::get();
        return view('SchoolAdmin.staff.addOrEdit',compact('strong_password','roles','states'));
    }
    public function editStaff($id = 0)
    {
        $states = states::get();
        $formData = User::findOrFail($id);
        $roles = Roles::whereIn('school_id',[0,Auth::user()->school_id])->whereNotIn('id',[env('SUPER_ADMIN_ROLE_ID'),env('SCHOOL_ADMIN_ROLE_ID'),env('STUDENT_ROLE_ID'),env('PARENT_ROLE_ID')])->where('status',1)->select('name','id')->get();
        return view('SchoolAdmin.staff.addOrEdit',compact('roles','formData','states'));
    }

    public function addOrUpdateStaffSubmit(Request $request, $id = "")
    {
        $validators = [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'role' => 'required',
            // 'pincode' => 'integer',
        ];
        $validator = Validator::make($request->all(), $validators);

        if ($validator->fails() && $id == "") {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $newStaff = $id == "" ? new user : user::findOrFail($id);
            $newStaff->name = isset($request->name) ? $request->name : "";
            $newStaff->email = isset($request->email) ? $request->email : "";
            $newStaff->password = Hash::make($request->password);
            $newStaff->role = isset($request->role) ? $request->role : "";
            $newStaff->phone = isset($request->phone) ? $request->phone : "";
            $newStaff->alt_phone = isset($request->alt_phone) ? $request->alt_phone : "";
            $newStaff->doj = isset($request->doj) ? $request->doj : "";
            $newStaff->school_id = Auth::user()->school_id;
            $newStaff->save();

            $staffAddress = $id == "" ? new userAddress : (userAddress::where('user_id', $id)->first() ? userAddress::where('user_id', $id)->first() : new userAddress);
            $staffAddress->house_no = isset($request->house_no) ? $request->house_no : "";
            $staffAddress->street = isset($request->street) ? $request->street : "";
            $staffAddress->city = isset($request->city) ? $request->city : "";
            $staffAddress->district = isset($request->district) ? $request->district : "";
            $staffAddress->state = isset($request->state) ? $request->state : "";
            $staffAddress->pincode = isset($request->pincode) ? $request->pincode : "";
            $staffAddress->user_id = $newStaff->id;
            $staffAddress->save();

            if(isset($request->profile_photo))
            {
                $userId = $id != "" ? $id : $newStaff->id;
                $user = User::findOrFail($userId);
                if (File::exists($user->profile_photo)) {
                    File::delete($user->profile_photo);
                }
                $user->profile_photo = isset($request->profile_photo) ? $this->upload($request->profile_photo,"uploads/schools/".$user->school_id."/".env('STAFF_PROFILE_PHOTO_PATH'),"PROFILE_PHOTO") : '';

                $user->save();
            }
            if($id != "") return response()->json(['success'=>"Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }
}
