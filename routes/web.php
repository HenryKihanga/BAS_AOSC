<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');







Route::get('/user/addUser', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('addUser')->middleware('auth');
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'view'])->name('profile')->middleware('auth');
Route::get('/user/allUsers', [App\Http\Controllers\UserController::class, 'viewAll'])->name('allUsers')->middleware('auth');
Route::get('/user/changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changepassword')->middleware('auth');
Route::get('/organization/index', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organization')->middleware('auth');
Route::get('/device/index', [App\Http\Controllers\DeviceController::class, 'index'])->name('device')->middleware('auth');

Route::get('showAllUsers', [App\Http\Controllers\RoughController::class, 'show_all_users'])->name('showAllUsers')->middleware('auth');