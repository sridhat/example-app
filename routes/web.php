<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
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
    return view('login');

});



// custom auth
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// forget password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

//captcha
Route::get('my-captcha', [HomeController::class,'myCaptcha'])->name('myCaptcha');
Route::post('my-captcha', [HomeController::class,'myCaptchaPost'])->name('myCaptcha.post');
Route::get('refresh_captcha', [HomeController::class,'refreshCaptcha'])->name('refresh_captcha');


// check in
Route::post('check_in_process', [HomeController::class,'check_in_process'])->name('check_in_process');
Route::post('check_out_process', [HomeController::class,'check_out_process'])->name('check_out_process');

Route::get('attedence_report',[HomeController::class,'attedence_report'])->name('attedence_report');
Route::post('check_in_check',[HomeController::class,'check_in_check'])->name('check_in_check');
Route::post('check_out_check',[HomeController::class,'check_out_check'])->name('check_out_check');
Route::post('attedence_report_data',[HomeController::class,'attedence_report_data'])->name('attedence_report_data');
Route::post('restore_process',[HomeController::class,'restore_process'])->name('restore_process');
