<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomAuthController;

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



Route::get('/', function () {
    return view('auth.register');
});

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => ['custom_auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'AdminDashboard'])->name('dashboard');
    route::get('/profile/{request_type}', [ProfileController::class, 'handleMyprofileRequest'])->name('handle_my_profile_request');
    route::post('/profile/{request_type}', [ProfileController::class, 'handleMyprofileRequest'])->name('handle_my_profile_request');
});

Route::get('/{command_type}', [BaseController::class, 'ClearCache'])->name('admin.clear-cache')->middleware('custom_auth');

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::post('/register/save', [CustomAuthController::class, 'registration'])->name('register')->middleware('custom_guest');
    Route::get('/login', [CustomAuthController::class, 'login'])->name('login')->middleware('custom_guest');
    Route::post('/login/save', [CustomAuthController::class, 'loginUser'])->name('loginUser');
    Route::post('/logout', [CustomAuthController::class, 'logoutUser'])->name('logoutUser');
    Route::get('/reset-password', [CustomAuthController::class, 'ShowResetPasswordView'])->name('reset-password')->middleware('custom_guest');
    Route::post('/send-reset-link', [CustomAuthController::class, 'SendResetLink'])->name('send-link');
    Route::get('/show-reset-password-view/{token}', [CustomAuthController::class, 'ChangePasswordView'])->name('reset-password-view');
    Route::post('/change-password', [CustomAuthController::class, 'ChangePassword'])->name('change-password');
});

require __DIR__.'/teacher.php';
require __DIR__.'/auth.php';
require __DIR__.'/subject.php';

Route::fallback(function(){
    return \Response::view('errors.404');
});


