<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/user_login', [LoginController::class, 'user_login'])->name('user_login');
Route::POST('/user_login_store', [LoginController::class, 'user_login_store'])->name('user_login_store');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/user_update/{id}', [UserController::class, 'update'])->name('user_update.update');

Route::get('/blog_list', [BlogController::class, 'index'])->name('users.blog_list');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin_edit/{id}', [AdminController::class, 'edit'])->name('admin_edit.edit');
Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update');


Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
});