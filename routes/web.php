<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolHomePageHandllerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix(HomeController::addSubdomineTOEveryRoute())->group(function () {
    Route::get('/',[SchoolHomePageHandllerController::class,'loadHomePage'])->middleware('subdomain')->name('subdomain.home');
    Route::get('/redirect-user-to-paticular-dahsboard',[HomeController::class,"index"])->name('redirect.to.paticular.dashboard');
});
Route::get('/redirect-user-to-paticular-dahsboard',function (){
    return session()->has('subdomain') ? redirect(session()->get('subdomain','')."/redirect-user-to-paticular-dahsboard") : abort(404);
});
foreach (glob(__DIR__.'/sms/*.php') as $filename) {
    require $filename;
}

