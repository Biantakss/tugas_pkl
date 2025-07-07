<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_CategoryController;
use App\Http\Controllers\Admin_UserController;


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

Route::get('/admin/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/category', [Admin_CategoryController::class, 'index'])->name('admin.category');
Route::get('/admin/user', [Admin_UserController::class, 'index'])->name('admin.user');

