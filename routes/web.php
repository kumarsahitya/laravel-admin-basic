<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\TwoFactorAuthenticatedController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    // Authentication...
    Route::get('/', [LoginController::class, 'showLoginForm'])
        ->name('admin.login-view');

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('admin.login-view');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('admin.login');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('admin.logout');

    // Password Reset...
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('admin.password.request');

    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('admin.password.email');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('admin.password.reset');

    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])
        ->name('admin.password.update');

    // Two Factor Authentication...
    if (config('auth.2fa_enabled')) {
        Route::get('/two-factor-login', [TwoFactorAuthenticatedController::class, 'create'])
            ->name('admin.two-factor.login');

        Route::post('/two-factor-login', [TwoFactorAuthenticatedController::class, 'store'])
            ->name('admin.two-factor.post-login');
    }

    Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');
});
