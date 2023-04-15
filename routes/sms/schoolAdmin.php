<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolAdmin\DashboardController;
use App\Http\Controllers\SchoolAdmin\RolesAndPermissionsController;
use App\Http\Controllers\SchoolAdmin\StaffManagementController;

Route::prefix(HomeController::addSubdomineTOEveryRoute())->group(function () {
    Route::get('management/login', [LoginController::class, 'showLoginForm'])->name('subdomain.login');
    Route::post('management/login', [LoginController::class, 'login']);
    Route::post('management/logout', [LoginController::class, 'logout'])->name('subdomain.logout');

    Route::get('management/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('management/register', [RegisterController::class, 'register']);

    // Password reset routes
    Route::get('management/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('subdomain.password.request');
    Route::post('management/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('management/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('subdomain.password.reset');
    Route::post('management/password/reset', [ResetPasswordController::class, 'reset']);
    Route::group(
        ['prefix' => env('SCHOOL_ADMIN_SLUG_PATH'), 'as' => 'schooladmin.', 'namespace' => 'SchoolAdmin', 'middleware' => ['auth', 'role:School Admin']],
        function () {
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

            // Roles
            Route::get('/roles-permissions/roles/list', [RolesAndPermissionsController::class, 'rolesList'])->name('roles-permissions.roles.list');
            Route::get('/roles-permissions/roles/add', [RolesAndPermissionsController::class, 'addRole'])->name('roles-permissions.roles.add');
            Route::get('/roles-permissions/roles/{id}/edit', [RolesAndPermissionsController::class, 'editRole'])->name('roles-permissions.roles.edit');
            Route::get('/roles-permissions/roles/list/datatable', [RolesAndPermissionsController::class, 'rolesListDatatable'])->name('roles-permissions.roles.list.datatable');
            Route::post('/roles-permissions/roles/add-submit', [RolesAndPermissionsController::class, 'addOrUpdateSubmit'])->name('roles-permissions.roles.add.submit');
            Route::post('/roles-permissions/roles/{id}/edit-submit', [RolesAndPermissionsController::class, 'addOrUpdateSubmit'])->name('roles-permissions.roles.edit.submit');

            //Permissions
            Route::get('/roles-permissions/permissions/{id?}', [RolesAndPermissionsController::class, 'permissions'])->name('roles-permissions.permissions');
            Route::post('/roles-permissions/permissions/{role_id}/submit', [RolesAndPermissionsController::class, 'permissionsSubmit'])->name('roles-permissions.permissions.submit');

            // Staff Management
            Route::get('/staff-management/list', [StaffManagementController::class, 'staffList'])->name('staff-management.list');
            Route::get('/staff-management/add', [StaffManagementController::class, 'addStaff'])->name('staff-management.add');
            Route::get('/staff-management/{id}/edit', [StaffManagementController::class, 'editStaff'])->name('staff-management.edit');
            Route::post('/staff-management/{id}/edit', [StaffManagementController::class, 'addOrUpdateStaffSubmit'])->name('staff-management.edit.submit');
            Route::post('/staff-management/add', [StaffManagementController::class, 'addOrUpdateStaffSubmit'])->name('staff-management.add.submit');
            Route::get('/staff-management/list/datatable', [StaffManagementController::class, 'staffListDatatable'])->name('staff-management.list.datatable');
        }
    );
});
