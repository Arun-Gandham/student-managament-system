<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Parent\DashboardController;
use App\Http\Controllers\Parent\LoginController;

Route::prefix(HomeController::addSubdomineTOEveryRoute())->group(function () {
    Route::group([
        'prefix' => env('PARENT_SLUG_PATH'),
        'as' => 'parent.',
        'namespace' => 'parent',
        'middleware' => ['parentAuthenticate:Parent','subdomain']
    ], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::group([
        'prefix' => env('PARENT_SLUG_PATH'),
        'as' => 'parent.',
        'namespace' => 'parent',
        'middleware' => ['subdomain']
    ], function () {
        // Login Routes for students
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showlogin');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
