<?php

namespace App\Http\Middleware;

use App\Models\RolePermissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissionFor): Response
    {
        $module_id = $permissionFor[0];
        $perimsion_type = $permissionFor[1];
        if(!RolePermissions::where('module_id',$module_id)->where($perimsion_type,1)->where("school_id",auth()->user()->school_id)->where('role_id',auth()->user()->role)->exists()) abort(403, 'Unauthorized action.');
        return $next($request);
    }
}
