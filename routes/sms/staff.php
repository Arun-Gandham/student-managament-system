<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\studentController;

Route::prefix(HomeController::addSubdomineTOEveryRoute())->group(function () {
    Route::group([
        'prefix' => env('SCHOOL_STAFF_SLUG_PATH'),
        'as' => 'staff.',
        'namespace' => 'Staff',
        'middleware' => ['auth']
    ], function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Student
        Route::get('/student/list', [studentController::class, 'studentList'])->name('student.list');
        Route::get('/student/datatables/list', [studentController::class, 'StudentsListDatatable'])->name('student.datatable.list');
        Route::get('/student/add', [studentController::class, 'addStudent'])->name('student.add');
        Route::post('/student/add', [studentController::class, 'addOrEditStudentSubmit'])->name('student.add.submit');
        Route::get('/student/{id}/edit', [studentController::class, 'editStudent'])->name('student.edit');
        Route::post('/student/{id}/edit', [studentController::class, 'addOrEditStudentSubmit'])->name('student.edit.submit');
    });
});
