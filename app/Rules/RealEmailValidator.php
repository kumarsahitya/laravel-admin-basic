<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RealEmailValidator implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ((bool) preg_match('/^([a-z0-9\\+_\\-]+)(\\.[a-z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$/ix', $value)) {
            $fail('This Email is not a valid email address.');
        }
    }
}
