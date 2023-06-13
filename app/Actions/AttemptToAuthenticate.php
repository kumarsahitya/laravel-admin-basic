<?php


namespace App\Actions;

use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\TwoFactor\LoginRateLimiter;

final class AttemptToAuthenticate
{
    public function __construct(protected StatefulGuard $guard, protected LoginRateLimiter $limiter)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->guard->attempt(
            $request->only(config('auth.username'), 'password'),
            $request->filled('remember')
        )
        ) {
            return $next($request);
        }

        $this->throwFailedAuthenticationException($request);
    }

    protected function throwFailedAuthenticationException(Request $request): void
    {
        $this->limiter->increment($request);

        throw ValidationException::withMessages([config('auth.username') => [trans('auth.failed')]]);
    }
}
