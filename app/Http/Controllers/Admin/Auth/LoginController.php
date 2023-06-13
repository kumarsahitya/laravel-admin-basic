<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use App\Actions\AttemptToAuthenticate;
use App\Actions\RedirectIfTwoFactorAuthenticatable;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): View
    {
        return view('admin.pages.authentications.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($this->redirectPath());
    }

    public function redirectPath(): string
    {
        return route('admin.dashboard');
    }

    public function login(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Attempt to authenticate a new session.
        return $this->loginPipeline($request)->then(fn ($request) => $this->sendLoginResponse($request));
    }

    public function username(): string
    {
        return config('auth.username');
    }

    protected function loginPipeline(Request $request): \Illuminate\Pipeline\Pipeline
    {
        return (new Pipeline(app()))->send($request)->through(array_filter([
            RedirectIfTwoFactorAuthenticatable::class,
            AttemptToAuthenticate::class,
        ]));
    }

    protected function sendLoginResponse(Request $request): JsonResponse|RedirectResponse
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($this->redirectPath());
    }

    protected function guard(): StatefulGuard
    {
        return Auth::guard(config('auth.guard'));
    }
}
