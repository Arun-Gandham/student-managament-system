<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\StudentLoginController;

Route::prefix(HomeController::addSubdomineTOEveryRoute())->group(function () {
    Route::group([
        'prefix' => env('STUDENT_SLUG_PATH'),
        'as' => 'student.',
        'namespace' => 'student',
        'middleware' => ['studentAuthenticate', 'studentRole:Student']
    ], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::group([
        'prefix' => env('STUDENT_SLUG_PATH'),
        'as' => 'student.',
        'namespace' => 'student'
    ], function () {
        // Login Routes for students
        Route::get('/login', [StudentLoginController::class, 'showLoginForm'])->name('showlogin');
        Route::post('/login', [StudentLoginController::class, 'login'])->name('login');
        Route::post('/logout', [StudentLoginController::class, 'logout'])->name('logout');
    });
});
