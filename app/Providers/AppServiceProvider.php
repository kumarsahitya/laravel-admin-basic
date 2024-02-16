<?php

namespace App\Providers;

use App\Contracts\FailedTwoFactorLoginResponse as FailedTwoFactorLoginResponseContract;
use App\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;
use App\Http\Composers\GlobalComposer;
use App\Http\Middleware;
use App\Http\Responses\FailedTwoFactorLoginResponse;
use App\Models\Admin\System\Setting;
use App\Services\TwoFactor\TwoFactorAuthenticationProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;

class AppServiceProvider extends ServiceProvider
{
    protected array $middlewares = [
        'dashboard' => Middleware\Dashboard::class,
        'admin.guest' => Middleware\RedirectIfAuthenticated::class,
        'role' => RoleMiddleware::class,
        'permission' => PermissionMiddleware::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TwoFactorAuthenticationProviderContract::class, TwoFactorAuthenticationProvider::class);
        $this->app->singleton(FailedTwoFactorLoginResponseContract::class, FailedTwoFactorLoginResponse::class);

        $this->app->bind(StatefulGuard::class, fn () => Auth::guard(config('auth.guard', null)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->bootDateFormatted();
        $this->registerMiddleware($this->app['router']);
        view()->composer('*', GlobalComposer::class);
        Blade::anonymousComponentNamespace('admin.components', 'admin');

        if (Schema::hasTable('settings')) {
            config([
                'db_custom' => Setting::all([
                    'key', 'value',
                ])
                    ->keyBy('key') // key every setting by its name
                    ->transform(function ($setting) {
                        return $setting->value; // return only the value
                    })
                    ->toArray(), // make it an array
            ]);
        }
    }

    public function bootDateFormatted(): void
    {
        // setLocale for php. Enables ->formatLocalized() with localized values for dates.
        setlocale(LC_TIME, config('system.locale'));

        // setLocale to use Carbon source locales. Enables diffForHumans() localized.
        Carbon::setLocale(config('app.locale'));
    }

    public function registerMiddleware(Router $router): void
    {
        foreach ($this->middlewares as $name => $middleware) {
            $router->aliasMiddleware($name, $middleware);
        }
    }
}
