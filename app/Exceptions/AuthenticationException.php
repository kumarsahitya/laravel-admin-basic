<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException as BaseAuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthenticationException extends BaseAuthenticationException
{
    public function render(Request $request): JsonResponse|RedirectResponse
    {
        return $request->expectsJson()
            ? response()->json(['message' => $this->getMessage()], 401)
            : redirect()->guest($this->location());
    }

    protected function location(): string
    {
        if (Route::getRoutes()->hasNamedRoute('admin.login')) {
            return route('admin.login');
        }

        if (Route::getRoutes()->hasNamedRoute('login')) {
            return route('login');
        }

        return '/login';
    }
}
