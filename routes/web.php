<?php

use App\Http\Controllers\HomeController;
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
    Route::get('/redirect-user-to-paticular-dahsboard',[HomeController::class,"index"]);
});
foreach (glob(__DIR__.'/sms/*.php') as $filename) {
    require $filename;
}

Route::group(
    ['prefix' => HomeController::addSubdomineTOEveryRoute()],
    function () {
        Route::get('/123',function()
        {
            return "succes yar";
        });
    });
