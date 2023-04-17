<?php

namespace App\Http\Controllers;

use App\Models\RolePermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!auth()->check() && !auth()->guard('student')->check() && !auth()->guard('parent')->check())         return redirect('/');
        else if(auth()->user()->role == env('SUPER_ADMIN_ROLE_ID'))       return redirect()->route('superadmin.dashboard.index');
        else if(auth()->user()->role == env('SCHOOL_ADMIN_ROLE_ID'))      return redirect()->route('schooladmin.dashboard.index');
        else if(auth()->guard('student')->check())                        return redirect()->route('student.dashboard.index');
        else if(auth()->guard('parent')->check())                         return redirect()->route('parent.dashboard.index');
        else                                                              return redirect()->route('staff.dashboard.index');
    }

    public static function addSubdomineTOEveryRoute()
    {
        $subdomain = request()->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        if(!isset($subdomains[$subdomain]) && $subdomain != "superadmin") redirect('/login');
        return $subdomain;
    }
}
