<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankController;

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


    Route::iceaxe('sales', \App\Http\Controllers\SalesController::class);

    Route::iceaxe('product', \App\Http\Controllers\ProductController::class);
    Route::get("/product/stock/{id}", [ProductController::class, 'stock'])->name('product.stock');
    Route::post("/product/stock/update", [ProductController::class, 'stockUpdate'])->name('product.stock.update');


    Route::iceaxe('bank', \App\Http\Controllers\BankController::class);


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get("/", [DashboardController::class, 'main'])->name('home');

    Route::prefix('users')->group(function () {
        Route::get("/", [UserController::class, 'index'])->name('user_list')->middleware('acl:users');
        Route::get("/create", [UserController::class, 'create'])->name('user_create')->middleware('acl:users-create');
        Route::post("/save", [UserController::class, 'store'])->name('user_store')->middleware('acl:users-create');
        Route::get("/edit/{id}", [UserController::class, 'edit'])->name('user_edit')->middleware('acl:users-update');
        Route::post("/update", [UserController::class, 'update'])->name('user_update')->middleware('acl:users-update');
        Route::get("/delete/{id}", [UserController::class, 'destroy'])->name('user_delete')->middleware('acl:users-delete');
    });

    Route::prefix('permission')->group(function () {
        Route::get("/", [\App\Http\Controllers\PermissionController::class, 'index'])->name('permission_list')->middleware('acl:permisson');

    });
    Route::prefix('stock')->group(function () {
        Route::get('/', 'StockController@index')->name('stock.index');
        Route::get('/create', 'StockController@create');
        Route::post('/stock', 'StockController@store');
    });


});


