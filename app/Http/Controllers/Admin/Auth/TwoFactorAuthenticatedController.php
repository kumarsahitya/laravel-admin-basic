<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\TwoFactorLoginRequest;
use App\Http\Responses\FailedTwoFactorLoginResponse;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthenticatedController extends Controller
{
    public function __construct(protected StatefulGuard $guard)
    {
        $this->middleware('guest');
    }

    public function create(TwoFactorLoginRequest $request): View
    {
        if (!$request->hasChallengedUser()) {
            throw new HttpResponseException(redirect()->route('admin.login'));
        }

        return view('admin.pages.authentications.two-factor-login');
    }

    /**
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @throws ValidationException
     */
    public function store(TwoFactorLoginRequest $request): JsonResponse|RedirectResponse
    {
        $user = $request->challengedUser();

        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);
        } elseif (!$request->hasValidCode()) {
            return app(FailedTwoFactorLoginResponse::class);
        }

        $this->guard->login($user, $request->remember());

        $request->session()->regenerate();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('admin.dashboard'));
    }
}
