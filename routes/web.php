<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as Admin;
use App\Http\Controllers\Admin\StatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('user/{name}', [UserController::class, 'show']);

Route::get('/about', function () {
    return view('pages.about');
});

Route::middleware(['auth'])->group(function () {
   
    Route::group(['prefix' => 'app'], function()  
    {  
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('task', [DashboardController::class, 'task'])->name('task');
    });  
});  

Route::middleware(['is_admin'])->group(function () {
   
    Route::group(['prefix' => 'admin'], function()  
    {  
        Route::get('dashboard', [Admin::class, 'index']);
        Route::get('stats', [StatsController::class, 'index']);

    });  
 

});  



