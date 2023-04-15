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
        Cache::forget('permissions');
        Cache::forget('rootPermissions');
        if(!Auth::check()) return redirect('/');
        else if(Auth::user()->role == env('SUPER_ADMIN_ROLE_ID'))   return redirect()->route('superadmin.dashboard.index');
        else if(Auth::user()->role == env('SCHOOL_ADMIN_ROLE_ID'))  return redirect()->route('schooladmin.dashboard.index');
        else if(Auth::user()->role == env('STUDENT_ROLE_ID'))       return redirect()->route('schooladmin.dashboard.index');
        else if(Auth::user()->role == env('PARENT_ROLE_ID'))        return redirect()->route('schooladmin.dashboard.index');
        else
        {
            Cache::remember('permissions', env('CACHE_PERMISSION_MINUTES'), function () {
                return RolePermissions::where('school_id',Auth::user()->school_id)->where('role_id',Auth::user()->role)->get();
            });
            Cache::remember('rootPermissions', env('CACHE_PERMISSION_MINUTES'), function () {
                return RolePermissions::where([['school_id',Auth::user()->school_id],['role_id',Auth::user()->role]])->where(function($query) {
                    $query->where("is_view",1)
                        ->orWhere('is_add',1)
                        ->orWhere('is_edit',1)
                        ->orWhere('is_delete',1);
                })->get();
            });
            return redirect()->route('staff.dashboard.index');
        }
    }

    public static function addSubdomineTOEveryRoute()
    {
        $subdomain = request()->segment(1);
        $subdomains = unserialize(env("SUB_DOMAINS_SERIALIZED"));
        if(!isset($subdomains[$subdomain]) && $subdomain != "superadmin") { echo "Subdodfasdfmasdasdasin not found"; exit; }
        return $subdomain;
    }
}
