<?php

use App\Models\Organization;
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
    return view('auth.login');
});

Auth::routes();
Route::get('/dashboard/{userId}', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');






// Route::get('/user/addUser', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('addUser')->middleware('auth');
// Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'view'])->name('profile')->middleware('auth');

// Route::get('/user/changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changepassword')->middleware('auth');
// Route::get('/organization/index', [App\Http\Controllers\OrganizationController::class, 'index'])->name('organization')->middleware('auth');














// Route::get('/device/index', [App\Http\Controllers\DeviceController::class, 'index'])->name('device')->middleware('auth');




// Routes for organization controller
Route::get('organization/{id}', [App\Http\Controllers\OrganizationController::class, 'index'])->name('manageOrganization');
Route::get('organization/edit/{id}', [App\Http\Controllers\OrganizationController::class, 'edit'])->name('editOrganization');
Route::get('organization/showOne/{id}', [App\Http\Controllers\OrganizationController::class, 'showOne'])->name('showOneOrganization');
Route::get('organization/showAll', [App\Http\Controllers\OrganizationController::class, 'showAll'])->name('showAllOrganizations');
Route::get('organization/showLatestTen', [App\Http\Controllers\OrganizationController::class, 'showLatestTen'])->name('showLatestTenOrganizations');
Route::post('organization/store', [App\Http\Controllers\OrganizationController::class, 'store'])->name('storeOrganization');
Route::get('organization/returnName/{id}', [App\Http\Controllers\OrganizationController::class, 'returnName'])->name('returnOrganizationName');
Route::post('organization/update/', [App\Http\Controllers\OrganizationController::class, 'update'])->name('updateOrganization');

// Routes for Branch controller
Route::get('branch/showAll', [App\Http\Controllers\BranchController::class, 'showAll'])->name('showAllBranches');
Route::post('branch/store/', [App\Http\Controllers\BranchController::class, 'store'])->name('storeBranch');
Route::get('branch/{id}', [App\Http\Controllers\BranchController::class, 'index'])->name('manageBranch');
Route::get('branch/edit/{id}', [App\Http\Controllers\BranchController::class, 'edit'])->name('editBranch');
Route::get('branch/showOne/{id}', [App\Http\Controllers\BranchController::class, 'showOne'])->name('showOneBranch');


Route::post('branch/update', [App\Http\Controllers\BranchController::class, 'update'])->name('updateBranch');

// Routes for Department controller
Route::get('department/{id}', [App\Http\Controllers\DepartmentController::class, 'index'])->name('manageDepartment');
Route::get('department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('editDepartment');
Route::post('department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('storeDepartment');
Route::get('/department/showOne/{id}', [App\Http\Controllers\DepartmentController::class, 'showOne'])->name('showOneDepartment');
Route::get('/department/showAll', [App\Http\Controllers\DepartmentController::class, 'showAll'])->name('showAllDepartments');
Route::post('department/update', [App\Http\Controllers\DepartmentController::class, 'update'])->name('updateDepartment');

// Routes for Device controller
Route::post('device/store', [App\Http\Controllers\DeviceController::class, 'store'])->name('storeDevice');
Route::get('device/showAll', [App\Http\Controllers\DeviceController::class, 'showAll'])->name('showAllDevices');
Route::get('device/{id}', [App\Http\Controllers\DeviceController::class, 'index'])->name('deviceManage');
Route::get('device/edit/{id}', [App\Http\Controllers\DeviceController::class, 'edit'])->name('editDevice');
Route::get('device/showOne/{id}', [App\Http\Controllers\DeviceController::class, 'showOne'])->name('showOneDevice');
Route::post('device/update', [App\Http\Controllers\DeviceController::class, 'update'])->name('updateDevice');
Route::get('device/changeMode/{token}/{mode}', [App\Http\Controllers\DeviceController::class, 'changeMode'])->name('changeDeviceMode');
//hardware
Route::get('device/checkMode/{deviceToken}', [App\Http\Controllers\DeviceController::class, 'checkMode'])->name('checkDeviceMode');

// Routes for User controller
// Route::resource('/user','App\Http\Controllers\UserController');
Route::get('user/addUser', [App\Http\Controllers\UserController::class, 'create'])->name('addUser');
Route::get('user/showAll', [App\Http\Controllers\UserController::class, 'showAll'])->name('showAllUsers');
Route::post('user/prepareUserToEnroll', [App\Http\Controllers\UserController::class, 'prepareUserToEnroll'])->name('prepareUserToEnroll');
Route::get('user/details/{id}', [App\Http\Controllers\UserController::class, 'details'])->name('showUserDetails');
Route::get('user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('showUserProfile');
Route::get('user/allUsers/{id}', [App\Http\Controllers\UserController::class, 'index'])->name('allUsers');
Route::get('user/changePassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
Route::get('user/delete/{userId}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('deleteUser');

Route::get('user/showOne/{id}', [App\Http\Controllers\UserController::class, 'showOne'])->name('showOneUsers');
Route::post('user/addUser', [App\Http\Controllers\UserController::class, 'store'])->name('addUser');
//hardware
Route::get('user/fingerprintId/{deviceToken}', [App\Http\Controllers\UserController::class, 'fingerPrintId'])->name('userFingerPrintId');
Route::get('user/confirmEnrollment/{fingerPrintId}/{deviceToken}', [App\Http\Controllers\UserController::class, 'confirmEnrollment'])->name('confirmUserEnrollment');
Route::get('user/deleteUserEnrolled/{deviceToken}', [App\Http\Controllers\UserController::class, 'deleteUserEnrolled'])->name('userFingerPrintId');



// Routes for Log controller
Route::get('log/overall', [App\Http\Controllers\LogController::class, 'index'])->name('overallLogs');
//hardware
Route::get('log/checkInOrOut/{fingerPrintId}/{deviceToken}', [App\Http\Controllers\LogController::class, 'checkInOrOut'])->name('checkInOrOut');
