<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\students;
use App\Traits\FileHandling;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    use FileHandling;

    public function studentList()
    {
        return view('Staff.student.list');
    }

    public function rolesList()
    {
        return view('Staff.student.list');
    }

    public function addStudent($id = "")
    {
        $genders = Gender::get();
        return view('Staff.student.addOrEditStudent',compact('genders','id'));
    }

    public function addOrEditStudentSubmit(Request $request, $id = "")
    {
        $validators = [
            'first_name' => 'required',
            'sur_name' => 'required',
            'registration_number' => 'required|unique:students',
            'dob' => 'required',
            'gender' => 'required',
        ];
        $messages = [
            'first_name.required' => 'First Name field is required.',
            'sur_name.required' => 'Sur Name field is required.',
            'registration_number.required' => 'Registration Number field is required.',
            'registration_number.unique' => 'Registration Number already exists.',
            'dob.required' => 'Date of birth field is required.',
            'gender.required' => 'Gender field is required.',
        ];
        $validator = Validator::make($request->all(), $validators, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{

            $newStudent = $id != "" ? students::find($id): new students;
            $newStudent->first_name = isset($request->first_name) ? $request->first_name : "";
            $newStudent->last_name =  isset($request->last_name) ? $request->last_name : "";
            $newStudent->sur_name =  isset($request->sur_name) ? $request->sur_name : "";
            $newStudent->registration_number =  isset($request->registration_number) ? $request->registration_number : "";
            $newStudent->dob =  isset($request->dob) ? $request->dob : "";
            $newStudent->gender =  isset($request->gender) ? $request->gender : "";
            $newStudent->email =  isset($request->email) ? $request->email : "";
            $newStudent->phone =  isset($request->phone) ? $request->phone : "";
            $newStudent->password =  Hash::make($request->registration_number);

            if($id == "")
            {
                $newStudent->school_id = auth()->user()->school_id;
                $newStudent->role = env('STUDENT_ROLE_ID');
            }
            if(isset($request->profile_photo))
            {
                $schoolId = auth()->user()->school_id;
                if(isset($request->profile_photo))
                {
                    if ($id != "" && File::exists($newStudent->profile_photo)) {
                        File::delete($newStudent->profile_photo);
                    }
                    $newStudent->profile_photo = isset($request->profile_photo) ? $this->upload($request->profile_photo,"uploads/schools/".$schoolId."/".env('STUDENT_IMAGE_PATH'),time()) : '';
                }
            }
            $newStudent->save();
            if($id != "") return response()->json(['success'=>"Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // Duplicate entry error
                preg_match('/for key \'(.*?)\'/', $e->getMessage(), $matches);
                $keyName = $matches[1];
                $fieldName = str_replace('_unique', '', $keyName);
                return response()->json(['error' => "{$fieldName} already exists."], 400);
            } else {
                // Handle other types of errors
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }
    }
}
