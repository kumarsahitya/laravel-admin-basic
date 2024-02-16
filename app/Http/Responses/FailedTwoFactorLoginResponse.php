<?php

namespace App\Http\Responses;

use App\Contracts\FailedTwoFactorLoginResponse as FailedTwoFactorLoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class FailedTwoFactorLoginResponse implements FailedTwoFactorLoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @throws ValidationException
     */
    public function toResponse($request): RedirectResponse
    {
        $message = __('The provided two factor authentication code was invalid.');

        if ($request->wantsJson()) {
            throw ValidationException::withMessages(['code' => [$message]]);
        }

        return redirect()->route('admin.login')->withErrors(['email' => $message]);
    }
}
