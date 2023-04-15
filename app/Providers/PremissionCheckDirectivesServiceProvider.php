<?php

namespace App\Providers;

use App\Models\RolePermissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;

class PremissionCheckDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('havePermission', function ($params) {
            $paramsdata = explode(',', $params);
            $moduleId = $paramsdata[0];
            $actionType = $paramsdata[1];
            // Cache::flush();
            if (Cache::has('permissions')) {
                // Value is present in the cache
                $permissionsData = Cache::get('permissions');
            } else {
                // Value is not present in the cache, fetch it from the database
                $permissionsData = Cache::remember('permissions', env('CACHE_PERMISSION_MINUTES'), function () {
                    return RolePermissions::where('school_id',Auth::user()->school_id)->where('role_id',Auth::user()->role)->get();
                });
            }
            $permissionsData = $permissionsData->where('module_id',$moduleId)->where($actionType,1)->first() ? 1 : 0;
            return  "<?php if($permissionsData){ ?>";
        });
        Blade::directive('haveRootPermission', function ($moduleId) {
            Cache::flush();
            if (Cache::has('rootPermissions')) {
                // Value is present in the cache
                $permissionsData = Cache::get('rootPermissions');
            } else {
                // Value is not present in the cache, fetch it from the database
                $permissionsData = Cache::remember('rootPermissions', env('CACHE_PERMISSION_MINUTES'), function () {
                    return RolePermissions::where([['school_id',Auth::user()->school_id],['role_id',Auth::user()->role]])->where(function($query) {
                        $query->where("is_view",1)
                            ->orWhere('is_add',1)
                            ->orWhere('is_edit',1)
                            ->orWhere('is_delete',1);
                    })->get();
                });
            }
            $permissionsData = $permissionsData->where('module_id',$moduleId)->first() ? 1 : 0;
            return  "<?php if($permissionsData){ ?>";
        });
        Blade::directive('endhaveRootPermission', function () {
            return "<?php } ?>";
        });
        Blade::directive('endhavePermission', function () {
            return "<?php } ?>";
        });
    }
}
