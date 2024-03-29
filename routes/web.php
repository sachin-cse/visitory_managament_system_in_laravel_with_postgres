<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::post('/register/save', [CustomAuthController::class, 'registration'])->name('register');
    Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
    Route::post('/login/save', [CustomAuthController::class, 'loginUser'])->name('loginUser');
    Route::get('/dashboard', [DashboardController::class, 'AdminDashboard'])->name('dashboard');
    Route::get('/reset-password', [CustomAuthController::class, 'ShowResetPasswordView'])->name('reset-password');
    Route::post('/send-reset-link', [CustomAuthController::class, 'SendResetLink'])->name('send-link');
    Route::get('/show-reset-password-view/{token}', [CustomAuthController::class, 'ChangePasswordView'])->name('reset-password-view');
    Route::post('/change-password', [CustomAuthController::class, 'ChangePassword'])->name('change-password');
});

require __DIR__.'/auth.php';
