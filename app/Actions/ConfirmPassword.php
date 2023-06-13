<?php

namespace App\Actions;

use Illuminate\Contracts\Auth\StatefulGuard;

final class ConfirmPassword
{
    public function __invoke(StatefulGuard $guard, $user, string $password): bool
    {
        return $guard->validate([
            config('auth.username') => $user->{config('auth.username')},
            'password' => $password,
        ]);
    }
}
