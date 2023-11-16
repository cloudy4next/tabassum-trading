<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashBoardController;

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

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'loginViewShow'])->name('login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Route::get('/password/reset/{token}', [AuthController::class, 'passwordReset'])->name('password.reset');
    // Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.reset.update');
});


Route::middleware('auth')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get("/", [DashboardController::class, 'main'])->name('home');
});
