<?php

use App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', admin\DashboardController::class)->name('admin.dashboard');

Route::view('/profile', 'admin.pages.account.profile')->name('admin.profile');

Route::as('admin.')->group(function () {
    Route::resource('customers', admin\CustomerController::class);
});

Route::prefix('setting')->as('admin.settings.')->group(function () {
    Route::middleware(['permission:access_setting'])->group(function () {
        Route::view('/', 'admin.pages.settings.index')->name('index');
        Route::view('/legal', 'admin.pages.settings.legal')->name('legal');
        Route::view('/management/user/new', 'admin.pages.settings.management.create')->name('user.new');
        Route::view('/general', 'admin.pages.settings.general')->name('shop');

        Route::prefix('integrations')->group(function () {
            Route::view('/', 'pages.settings.integrations.index')->name('integrations');
            Route::view('/github', 'pages.settings.integrations.github')->name('integrations.github');
            Route::view('/twitter', 'pages.settings.integrations.twitter')->name('integrations.twitter');
        });
    });

    Route::middleware(['permission:view_users'])->group(function () {
        Route::view('/management', 'admin.pages.settings.management.index')->name('users');
        Route::get('/management/roles/{role}', [admin\SettingController::class, 'role'])->name('user.role');
    });

    Route::middleware(['permission:view_analytics|setting_analytics'])->group(function () {
        Route::view('/analytics', 'admin.pages.settings.analytics')->name('analytics');
    });

});
