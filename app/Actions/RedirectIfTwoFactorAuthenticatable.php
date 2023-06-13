<?php

namespace App\Actions;

use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\TwoFactor\LoginRateLimiter;
use App\Services\TwoFactor\TwoFactorAuthenticatable;

final class RedirectIfTwoFactorAuthenticatable
{
    public function __construct(protected StatefulGuard $guard, protected LoginRateLimiter $limiter)
    {
    }

    public function handle(Request $request, Closure $next): JsonResponse|RedirectResponse
    {
        $user = $this->validateCredentials($request);

        if (optional($user)->two_factor_secret &&
            in_array(TwoFactorAuthenticatable::class, class_uses_recursive($user))) {
            return $this->twoFactorChallengeResponse($request, $user);
        }

        return $next($request);
    }

    protected function validateCredentials(Request $request)
    {
        $model = $this->guard->getProvider()->getModel();

        return tap($model::where(config('auth.username'), $request->{config('auth.username')})->first(), function ($user) use ($request) {
            if (! $user || ! Hash::check($request->password, $user->password)) {
                $this->throwFailedAuthenticationException($request);
            }
        });
    }

    protected function throwFailedAuthenticationException(Request $request): void
    {
        $this->limiter->increment($request);

        throw ValidationException::withMessages([config('auth.username') => [trans('auth.failed')]]);
    }

    protected function twoFactorChallengeResponse(Request $request, $user): JsonResponse|RedirectResponse
    {
        $request->session()->put([
            'login.id' => $user->getKey(),
            'login.remember' => $request->filled('remember'),
        ]);

        return $request->wantsJson()
            ? response()->json(['two_factor' => true])
            : redirect()->route('admin.two-factor.login');
    }
}
