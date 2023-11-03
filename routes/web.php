<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CanAccessDonor;
use App\Http\Middleware\LoggedOut;
use Illuminate\Support\Facades\Route;

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

Route::middleware([LoggedOut::class])->group(function(){
    Route::get('/admin/login', [UserController::class, 'showAdminLogin']);
    Route::post('/admin/login', [UserController::class, 'postAdminLogin']);
    Route::get('/employee/login', [UserController::class, 'showEmployeeLogin']);
    Route::post('/employee/login', [UserController::class, 'postEmployeeLogin']);
    Route::get('/hospital/login', [UserController::class, 'showHospitalLogin']);
    Route::post('/hospital/login', [UserController::class, 'postHospitalLogin']);
    Route::get('/', [UserController::class, 'showLanding'])->name('home');
});
Route::get('/logout', [UserController::class, 'logout']);
// Admin only
Route::middleware(['auth:admin'])->group(function(){
    Route::get('/admin/dashboard', [UserController::class, 'showAdminDashboard']);
    Route::get('/hospital/register', [UserController::class, 'showRegisterHospital']);
    Route::post('/hospital/register', [UserController::class, 'postRegisterHospital']);
    Route::get('/employee/register', [UserController::class, 'showRegisterEmployee']);
    Route::post('/employee/register', [UserController::class, 'postRegisterEmployee']);
    Route::get('/hospital/detail/{id}', [UserController::class, 'showHospitalDetail']);
    Route::get('/employee/detail/{id}', [UserController::class, 'showEmployeeDetail']);
});
// Employees only
Route::middleware(['auth:employee'])->group(function(){
    Route::get('/employee/dashboard', [UserController::class, 'showEmployeeDashboard']);
    Route::get('/donor/register', [DonationController::class, 'showRegisterDonor']);
    Route::post('/donor/register', [DonationController::class, 'postRegisterDonor']);
    Route::post('/donate/{donor}', [DonationController::class, 'postRegisterDonation']);
});
// Hospitals only
Route::middleware(['auth:hospital'])->group(function(){
    Route::get('/hospital/dashboard', [UserController::class, 'showHospitalDashboard']);
    Route::get('/orders', [UserController::class, 'showHospitalOrders']);
    Route::post('/order/complete/{order}', [DonationController::class, 'postOrderCompletion']);
    Route::post('/order/{donor}', [DonationController::class, 'postOrderDonation']);
});
// Hospital and Employee
Route::middleware([CanAccessDonor::class])->group(function(){
    Route::get('/donor/detail/{donor}', [DonationController::class, 'showDonorDetail']);
});
