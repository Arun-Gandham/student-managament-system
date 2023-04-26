<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;

class SchoolHomePageHandllerController extends Controller
{
    public function loadHomePage(Request $request)
    {
        $subdomain = $request->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        $schooData = Schools::where('subdomain_id',$subdomains[$subdomain])->first();
        return view('home',compact('schooData'));
    }
}
