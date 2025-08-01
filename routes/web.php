<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_CategoryController;
use App\Http\Controllers\Admin_UserController;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


route::middleware(('auth'))->group(function () {

    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('dashboard');

Route::get('/admin/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/category', [Admin_CategoryController::class, 'index'])->name('admin.category');
Route::post('/admin/categoy/tambah', [Admin_CategoryController::class, 'TambahDataCategory'])->name('admin.TambahDataCategory');
Route::post('/admin/category/hapus', [Admin_CategoryController::class, 'hapusDataCategory'])->name('admin.hapusDataCategory');
Route::post('/admin/category/edit', [Admin_CategoryController::class, 'editDataCategory'])->name('admin.editDataCategory');



Route::get('/admin/user', [Admin_UserController::class, 'index'])->name('admin.user');
Route::post('/admin/user/tambah', [Admin_UserController::class, 'TambahDataUser'])->name('admin.TambahDataUser');
Route::post('/admin/user/hapus', [Admin_UserController::class, 'hapusDataUser'])->name('admin.hapusDataUser');
Route::post('/admin/user/edit', [Admin_UserController::class, 'editDataUser'])->name('admin.editDataUser');
});


