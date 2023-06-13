<?php

namespace App\Services\TwoFactor;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginRateLimiter
{
    public function __construct(protected RateLimiter $limiter)
    {
    }

    public function tooManyAttempts(Request $request): bool
    {
        return $this->limiter->tooManyAttempts($this->throttleKey($request), 5);
    }

    public function increment(Request $request): void
    {
        $this->limiter->hit($this->throttleKey($request), 60);
    }

    public function availableIn(Request $request): int
    {
        return $this->limiter->availableIn($this->throttleKey($request));
    }

    public function clear(Request $request): void
    {
        $this->limiter->clear($this->throttleKey($request));
    }

    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input(config('auth.username'))) . '|' . $request->ip();
    }
}
