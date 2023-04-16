<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\permissionModule;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class PermissionModuleController extends Controller
{
    public function list()
    {
        return view('SuperAdmin.permissionModules.list');
    }

    public function moduleListdatatable()
    {
        $modules = permissionModule::get();
        return DataTables::of($modules)
        ->addIndexColumn()
        ->addColumn('actions', function ($module) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
                    <a href="'.route("superadmin.modules.edit",["id" => $module->id]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->addColumn('description', function ($module) {
            return strlen($module->description) > 110 ? substr($module->description, 0, 110) . "..." : $module->description;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function addModule()
    {
        return view('SuperAdmin.permissionModules.addOrEdit');
    }

    public function createAndUpdateModuleSubmit(Request $request,$id = "")
    {
        $validators = [
            'name' => 'required|unique:permission_module',
            'description' => 'required',
        ];
        if($id != "") $validators['name'] = 'required';
        $messages = [
            'name.unique' => 'Module already created with that name.'
        ];
        $validator = Validator::make($request->all(), $validators, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $newModule = $id != "" ?  permissionModule::findOrFail($id) : new permissionModule;
            $newModule->name = isset($request->name) ? $request->name : "";
            $newModule->description = isset($request->description) ? $request->description : "";
            $newModule->save();
            $this->updateModuleIdsENV();
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
        $formData = permissionModule::where("id",$id)->first();
        return view('SuperAdmin.permissionModules.addOrEdit',compact('formData'));
    }

    public static function updateModuleIdsENV():void
    {
        $modules = permissionModule::where('status',1)->select('id','name')->get();
        $availableModules = [];
        foreach($modules as $module)
        {
            $availableModules[$module['name']] = $module['id'];
        }
        $serializedData = "'".serialize($availableModules)."'";
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'MODULES_WITH_ID_SERIALIZED='.env('MODULES_WITH_ID_SERIALIZED'), 'MODULES_WITH_ID_SERIALIZED='.$serializedData, file_get_contents($path)
            ));
        }
    }
}
