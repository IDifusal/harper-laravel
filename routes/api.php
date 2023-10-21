<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisterController; 

use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
// });

// Login
// Route::get('/testing', function() {
//     return view('app');
// })->name('login');
// Route::get('/custom/verify/{id}/{hash}', [VerificationController::class, 'verify']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']); // Use the RegisterController for registratio
// Logout
Route::post('/logout', [LoginController::class, 'logout']);

// Password Reset
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);

// Email Verification
Route::get('/email/verify', function () {
    dd('test2');
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    dd($request);
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('login');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
