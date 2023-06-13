<?php

namespace App\Providers;

use App\Contracts\FailedTwoFactorLoginResponse as FailedTwoFactorLoginResponseContract;
use App\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;
use App\Http\Composers\GlobalComposer;
use App\Http\Responses\FailedTwoFactorLoginResponse;
use App\Services\TwoFactor\TwoFactorAuthenticationProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TwoFactorAuthenticationProviderContract::class, TwoFactorAuthenticationProvider::class);
        $this->app->singleton(FailedTwoFactorLoginResponseContract::class, FailedTwoFactorLoginResponse::class);

        $this->app->bind(StatefulGuard::class, fn() => Auth::guard(config('auth.guard', null)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        view()->composer('*', GlobalComposer::class);
        Blade::anonymousComponentNamespace('admin.components', 'admin');
    }
}
