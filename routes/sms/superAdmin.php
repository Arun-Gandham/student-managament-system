<?php

use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\EnvManagementController;
use App\Http\Controllers\SuperAdmin\PermissionModuleController;
use App\Http\Controllers\SuperAdmin\SchoolController;

Route::group([
    'prefix' => env('SUPER_ADMIN_SLUG_PATH'),
    'as' => 'superadmin.',
    'namespace' => 'SuperAdmin',
    'middleware' => ['auth','role:Super Admin']
], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');

    //School routes start
    Route::get('/school/list', [SchoolController::class,'list'])->name('school.list');
    Route::get('/school/create', [SchoolController::class,'create'])->name('school.create');
    Route::get('/school/{id}/edit', [SchoolController::class,'edit'])->name('school.edit');
    Route::get('/school/datatable-list', [SchoolController::class,'schoolListdatatable'])->name('school.datatable.list');
    Route::post('/school/create', [SchoolController::class,'createAndUpdateSchoolSubmit'])->name('school.create.submit');
    Route::post('/school/{id}/edit', [SchoolController::class,'createAndUpdateSchoolSubmit'])->name('school.edit.submit');
    //School routes end

    // Permission Modules
    Route::get('/modules/list', [PermissionModuleController::class,'list'])->name('modules.list');
    Route::get('/modules/add', [PermissionModuleController::class,'addModule'])->name('modules.add');
    Route::get('/modules/{id}/edit', [PermissionModuleController::class,'edit'])->name('modules.edit');
    Route::get('/modules/datatable-list', [PermissionModuleController::class,'moduleListdatatable'])->name('module.datatable.list');
    Route::post('/modules/add', [PermissionModuleController::class,'createAndUpdateModuleSubmit'])->name('module.add.submit');
    Route::post('/modules/{id}/edit', [PermissionModuleController::class,'createAndUpdateModuleSubmit'])->name('module.edit.submit');

    // Env Management
    Route::get('/subdomain/list', [EnvManagementController::class,'listSubdomain'])->name('subdomain.list');
    Route::get('/subdomain/list/datatable', [EnvManagementController::class,'listSubdomainDatatable'])->name('subdomain.list.datatable');
    Route::get('/subdomain/add', [EnvManagementController::class,'addSubdomain'])->name('subdomain.add');
    Route::post('/subdomain/add', [EnvManagementController::class,'addSubdomainSubmit']);
    Route::get('/subdomain/{id}/edit', [EnvManagementController::class,'editSubdomain'])->name('subdomain.edit');
    Route::post('/subdomain/{id}/edit', [EnvManagementController::class,'addSubdomainSubmit']);
    Route::get('/subdomain/update/env', [EnvManagementController::class,'updateEnv'])->name('subdomain.update.env');
    Route::get('/subdomain/get/env', [EnvManagementController::class,'checkEnv'])->name('subdomain.get.env');

});
