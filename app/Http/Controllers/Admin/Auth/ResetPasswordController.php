<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\Password;
use App\Rules\RealEmailValidator;

class ResetPasswordController extends Controller
{
    use ValidatesRequests;
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, ?string $token = null): View
    {
        return view('admin.pages.authentications.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function redirectPath(): string
    {
        return '';
    }

    protected function rules(): array
    {
        return [
            'token' => 'required',
            'email' => ['required', 'email', new RealEmailValidator()],
            'password' => [
                'required',
                Password::min(8)->numbers()->symbols()->mixedCase(),
            ],
        ];
    }
}
