<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use App\Models\subdomains;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\StrongPassword;
use App\Traits\FileHandling;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use File;
class SchoolController extends Controller
{
    use StrongPassword;
    use FileHandling;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        return view('SuperAdmin.school.list');
    }

    public function create()
    {
        $strong_password = $this->generatePassword();
        $subdomains = subdomains::where('status',1)->get();
        return view('SuperAdmin.school.create',compact('strong_password','subdomains'));
    }
    public function schoolListdatatable()
    {
        $schools = Schools::join('users', 'users.school_id', '=', 'schools.id')->where('users.role',env('SCHOOL_ADMIN_ROLE_ID'))->select(['users.school_id','users.email','schools.*'])->orderBy('schools.id','desc')->get();
        return DataTables::of($schools)
        ->addIndexColumn()
        ->addColumn('actions', function ($school) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
                    <a href="'.route("superadmin.school.edit",["id" => $school["id"]]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->addColumn('school_status', function ($school) {
            return $school->school_status == "1" ? "Yes" : "No";
        })
        ->rawColumns(['actions','status'])
        ->make(true);
    }
    public function createAndUpdateSchoolSubmit(Request $request, $id = "")
    {
        $validators = [
            'school_name' => 'required',
            'subdomain_id' => 'required'
        ];
        $messages = [
            'school_name.required' => 'School name field is required.',
            'school_name.unique' => 'School name has already been taken.'
        ];
        if($id == "")
        {
            $validators = [
                'school_name' => 'required|unique:schools',
                'subdomain_id' => 'required|unique:schools'
            ];
            $validators['email'] = 'required|email|unique:users';
            $validators['password'] = 'required|min:6';
            $messages = [
                'email.required' => 'Admin email field is required.',
                'email.email' => 'Admin email must be a valid email address.',
                'email.unique' => 'Admin email has already been taken.',
                'subdomain_id.unique' => 'Subdomain has already been taken.',
                'password.required' => 'Admin password field is required.',
                'password.min' => 'Admin password must be at least 8 characters.',
            ];
        }
        $validator = Validator::make($request->all(), $validators, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $new_school = [
                'school_name' => isset($request->school_name) ? $request->school_name : '',
                'school_description' => isset($request->school_description) ? $request->school_description : '',
                'school_started_on' => isset($request->started_on) ? $request->started_on : '',
                'school_land_line' => isset($request->land_line) ? $request->land_line : '',
                'school_phone1' => isset($request->primary_contact_number) ? $request->primary_contact_number : '',
                'school_phone2' => isset($request->secondary_contact_number) ? $request->secondary_contact_number : '',
                'school_address1' => isset($request->address1) ? $request->address1 : '',
                'school_address2' => isset($request->address2) ? $request->address2 : '',
                'school_street' => isset($request->street) ? $request->street : '',
                'school_city' => isset($request->city) ? $request->city : '',
                'school_district' => isset($request->district) ? $request->district : '',
                'school_state' => isset($request->state) ? $request->state : '',
                'school_pincode' => isset($request->pincode) ? $request->pincode : '',
                'school_meta_title' => isset($request->school_meta_title) ? $request->school_meta_title : '',
                'school_short_name' => isset($request->short_name) ? $request->short_name : '',
                'school_short_description' => isset($request->short_description) ? $request->short_description : '',
                'subdomain_id' => isset($request->subdomain_id) ? $request->subdomain_id : '',
            ];

            if($id != "")
            {
                $school = Schools::findOrFail($id);
                $school->update($new_school);
                $schoolAdmin = User::where('school_id', $id)->firstOrFail();
                $fieldsSetup = ['name' => $request->school_name,'email' => $request->email];
                if($request->password != "")
                {
                    $fieldsSetup['password'] = Hash::make($request->password);
                }
                $schoolAdmin->update($fieldsSetup);
            }
            else{
                $new_school = Schools::create($new_school);
                User::create([
                    'name' => $request->school_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => env('SCHOOL_ADMIN_ROLE_ID'),
                    'school_id' => $new_school->id
                ]);
            }

            if(isset($request->school_image) || isset($request->school_favicon))
            {
                $schoolId = $id != "" ? $id : $new_school->id;
                $school = Schools::findOrFail($schoolId);
                $uploadImageField = [];
                if(isset($request->school_image))
                {
                    if (File::exists($school->school_image)) {
                        File::delete($school->school_image);
                    }
                    $uploadImageField['school_image'] = isset($request->school_image) ? $this->upload($request->school_image,"uploads/schools/".$schoolId.env('SCHOOL_IMAGE_PATH'),"SCHOOL_IMAGE") : '';
                }
                if(isset($request->school_favicon))
                {
                    if (File::exists($school->school_favicon)) {
                        File::delete($school->school_favicon);
                    }
                    $uploadImageField['school_favicon'] = isset($request->school_favicon) ? $this->upload($request->school_favicon,"uploads/schools/".$schoolId.env('SCHOOL_FAVICON_PATH'),"FAVICON") : '';
                }
                $school->update($uploadImageField);
            }
            if($id != "") return response()->json(['success'=> "Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    public function edit($id)
    {
        $subdomains = subdomains::where('status',1)->get();
        $formData = Schools::join('users', 'users.school_id', '=', 'schools.id')->where("schools.id",$id)->select(['users.school_id','users.email','schools.*'])->first();
        return view('SuperAdmin.school.create',compact('formData','subdomains'));
    }

}
