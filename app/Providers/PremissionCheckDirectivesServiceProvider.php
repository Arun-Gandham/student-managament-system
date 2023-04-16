<?php

namespace App\Providers;

use App\Models\RolePermissions;
use Illuminate\Http\Request;
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
        Blade::if('havePermission', function ($params) {
            $paramsdata = explode(',', $params);
            $moduleId = session()->get('modules')[$paramsdata[0]];
            $actionType = $paramsdata[1];
            $havePermission = isset(session()->get('permissions')[$moduleId]) && isset(session()->get('permissions')[$moduleId][$actionType]) && session()->get('permissions')[$moduleId][$actionType] ? 1 : 0;
            return  $havePermission;
        });
        Blade::if('haveRootPermission', function ($module) {
            $moduleId = session()->get('modules')[$module];
            $havePermission = isset(session()->get('permissions')[$moduleId]) && (session()->get('permissions')[$moduleId]['is_view'] || session()->get('permissions')[$moduleId]['is_edit'] || session()->get('permissions')[$moduleId]['is_add'] || session()->get('permissions')[$moduleId]['is_delete']) ? 1 : 0;
            return $havePermission;
        });
    }
}
