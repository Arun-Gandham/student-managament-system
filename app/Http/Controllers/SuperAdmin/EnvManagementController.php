<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\subdomains;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class EnvManagementController extends Controller
{
    public function addSubdomain()
    {
        return view('SuperAdmin.envManagement.addOrEdit');
    }

    public function addSubdomainSubmit(Request $request,$id="")
    {
        $validators = [
            'subdomain' => 'required|unique:subdomains',
            'strong_id' => 'required|unique:subdomains',
        ];
        if($id != "")
        {
            $validators = [
                'subdomain' => 'required',
                'strong_id' => 'required',
            ];
        }
        $validator = Validator::make($request->all(), $validators);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $newSubdomain = $id != "" ? subdomains::find($id) : new subdomains;
            $newSubdomain->subdomain = $request->subdomain;
            $newSubdomain->status = (int) $request->status;
            if($id == "") $newSubdomain->strong_id = $request->strong_id;
            $newSubdomain->save();
            $this->updateDomainsInENV();
            if($id != "") return response()->json(['success'=> "Successfully updated"],200);
            return response()->json(['success'=>"Successfully created"],201);
        }
        catch(Exception $e)
        {
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    function editSubdomain($id)
    {
        $formData = subdomains::where('id',$id)->first();
        return view('SuperAdmin.envManagement.addOrEdit',compact('formData','id'));
    }

    public function listSubdomainDatatable()
    {
        $subdomains = subdomains::orderBy('id','desc')->get();
        return DataTables::of($subdomains)
        ->addIndexColumn()
        ->addColumn('actions', function ($subdomain) {
            return '<a href="" class="btn btn-xs btn-primary"><img src="'.asset("svg/eye.svg").'" atl="view"></a>
                    <a href="'.route("superadmin.subdomain.edit",["id" => $subdomain["id"]]).'" class="btn btn-xs btn-info"><img src="'.asset("svg/edit.svg").'" atl="edit"></a>
                    <form method="POST" action="" style="display:inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure you want to delete this user?\')"><img src="'.asset("svg/trash.svg").'" atl="delete"></button>
                    </form>';
        })
        ->addColumn('status', function ($subdomain) {
            return $subdomain->status == "1" ? "Yes" : "No";
        })
        ->rawColumns(['actions','status'])
        ->make(true);
    }

    public function listSubdomain()
    {
        return view('SuperAdmin.envManagement.list');
    }

    public function checkEnv()
    {
        $dbSubdomains = subdomains::where('status',1)->get();
        $availableSubdomains = [];
        foreach($dbSubdomains as $eachSubdomain)
        {
            $availableSubdomains[$eachSubdomain->subdomain] = $eachSubdomain->strong_id;
        }
        $dbSubdomainsSerialized = serialize($availableSubdomains) ?? "";
        $subdomainData = env('SUB_DOMAINS_SERIALIZED');
        $subdomainDataUnserialized = $subdomainData != "" ? unserialize($subdomainData) : [];
        return view('SuperAdmin.envManagement.checkEnv',compact('subdomainData','subdomainDataUnserialized','availableSubdomains','dbSubdomainsSerialized'));
    }

    public function updateEnv()
    {
        $this->updateDomainsInENV();
        return redirect()->route('superadmin.subdomain.get.env');
    }

    public function updateDomainsInENV()
    {
        $dbSubdomains = subdomains::where('status',1)->get();
        $availableSubdomains = [];
        foreach($dbSubdomains as $eachSubdomain)
        {
            $availableSubdomains[$eachSubdomain->subdomain] = $eachSubdomain->strong_id;
        }
        $serializedData = serialize($availableSubdomains);
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'SUB_DOMAINS_SERIALIZED='.env('SUB_DOMAINS_SERIALIZED'), 'SUB_DOMAINS_SERIALIZED='.$serializedData, file_get_contents($path)
            ));
        }
    }
}
