<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCardDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the expiration date is in MM/YY format
        $pattern = '/^(0[1-9]|1[0-2])\/([0-9]{2})$/';
        if (!preg_match($pattern, $value)) {
            $fail('Invalid expiration date format. Please use MM/YY.');
        }

        // Extract the month and year
        [$month, $year] = explode('/', $value);

        // Check if the expiration date is in the future
        $currentYear = date('y');
        $currentMonth = date('m');

        if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
            $fail('Invalid date. The card has expired.');
        }
    }
}
