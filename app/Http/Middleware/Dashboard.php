<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Dashboard
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth(config('auth.defaults.guard'))->user();
        // Check if the user is super admin or have to ability to access to the backend
        if (! $user->isAdmin() && ! $user->hasPermissionTo('access_dashboard')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response(__('Unauthorized'), Response::HTTP_UNAUTHORIZED);
            }

            abort(403, __('Unauthorized'));
        }

        return $next($request);
    }
}
