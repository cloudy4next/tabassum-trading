<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UserController;

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


    Route::prefix('bank')->group(function () {
        Route::get('/', [\App\Http\Controllers\BankController::class, 'index'])->name('bank')->middleware('acl:bank');
        Route::get('/create', [\App\Http\Controllers\BankController::class, 'create'])->name('bank.create')->middleware('acl:bank-create');
        Route::post('/save', [\App\Http\Controllers\BankController::class, 'store'])->name('bank.store')->middleware('acl:bank-create');
        Route::get('/edit/{id}', [\App\Http\Controllers\BankController::class, 'edit'])->name('bank.edit')->middleware('acl:bank-update');
        Route::post('/update', [\App\Http\Controllers\BankController::class, 'update'])->name('bank.update')->middleware('acl:bank-update');
        Route::get('/delete/{id}', [\App\Http\Controllers\BankController::class, 'delete'])->name('bank.delete')->middleware('acl:bank-delete');
    });


    Route::prefix('product')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('product')->middleware('acl:product');
        Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('product.create')->middleware('acl:product-create');
        Route::post('/save', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store')->middleware('acl:product-create');
        Route::get('/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit')->middleware('acl:product-update');
        Route::post('/update', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update')->middleware('acl:product-update');
        Route::get('/delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete')->middleware('acl:product-delete');
    });


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


});


