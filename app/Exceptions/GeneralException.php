<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class GeneralException extends Exception
{
    /**
     * Error Message.
     *
     * @var string
     */
    public $message;

    public function render(): RedirectResponse
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('danger', $this->message);
    }
}
