<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Psy\Readline\HoaConsole;

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
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-process', [LoginController::class, 'login_process'])->name('login-process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-process', [LoginController::class, 'register_process'])->name('register-process');

Route::group(['prefix'=>'admin', 'middleware'=>['auth'], 'as'=> 'admin.'], function() {
    Route::get('/admin', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/user', [HomeController::class, 'index'])->name('user');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    route::post('/store', [HomeController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('update/{id}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('delete/{id}', [HomeController::class, 'delete'])->name('user.delete');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');