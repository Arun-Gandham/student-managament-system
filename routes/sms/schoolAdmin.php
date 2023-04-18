<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolAdmin\ClassesSectionsController;
use App\Http\Controllers\SchoolAdmin\DashboardController;
use App\Http\Controllers\SchoolAdmin\RolesAndPermissionsController;
use App\Http\Controllers\SchoolAdmin\StaffManagementController;
use App\Http\Controllers\SchoolAdmin\studentController;

Route::middleware('subdomain',)->group(function () {
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

                // Student
                Route::get('/sections-by-class', [studentController::class, 'getSections'])->name('sections.by.class');
                Route::get('/student/list', [studentController::class, 'studentList'])->name('student.list');
                Route::get('/student/datatables/list', [studentController::class, 'StudentsListDatatable'])->name('student.datatable.list');
                Route::get('/student/add', [studentController::class, 'addStudent'])->name('student.add');
                Route::post('/student/add', [studentController::class, 'addOrEditStudentSubmit'])->name('student.add.submit');
                Route::get('/student/{id}/edit', [studentController::class, 'editStudent'])->name('student.edit');
                Route::post('/student/{id}/edit', [studentController::class, 'addOrEditStudentSubmit'])->name('student.edit.submit');

                // classes and sections
                Route::get('/class-section/classes/list', [ClassesSectionsController::class, 'listClasses'])->name('class-sections.classes.list');
                Route::get('/class-section/sections/list', [ClassesSectionsController::class, 'listSections'])->name('class-sections.sections.list');
                Route::get('/class-section/classes/datatables/list', [ClassesSectionsController::class, 'classesListDatatable'])->name('class-sections.classes.datatable.list');
                Route::get('/class-section/sections/datatables/list', [ClassesSectionsController::class, 'sectionsListDatatable'])->name('class-sections.sections.datatable.list');
                // classes
                Route::get('/class/add', [ClassesSectionsController::class, 'addClass'])->name('class-sections.class.add');
                Route::post('/class/add', [ClassesSectionsController::class, 'addOrEditClassSubmit'])->name('class-sections.class.add.submit');
                Route::get('/class/{id}/edit', [ClassesSectionsController::class, 'editClass'])->name('class-sections.class.edit');
                Route::post('/class/{id}/edit', [ClassesSectionsController::class, 'addOrEditClassSubmit'])->name('class-sections.class.edit.submit');
                // classes
                Route::get('/section/add', [ClassesSectionsController::class, 'addSection'])->name('class-sections.section.add');
                Route::post('/section/add', [ClassesSectionsController::class, 'addOrEditSectionSubmit'])->name('class-sections.section.add.submit');
                Route::get('/section/{id}/edit', [ClassesSectionsController::class, 'editSection'])->name('class-sections.section.edit');
                Route::post('/section/{id}/edit', [ClassesSectionsController::class, 'addOrEditSectionSubmit'])->name('class-sections.section.edit.submit');



            }
        );
    });
});
