<?php

namespace App\Rules;

use App\Models\Admin;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidRegistrationToken implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $registrationTokenExists = Admin::where('registration_token', $value)->first();

        if (!$registrationTokenExists) {
            $fail('The registration token is invalid.');
        }
    }
}
