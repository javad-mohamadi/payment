<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckCardBank implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->validateCardNumber($value)) {
            $fail('The :attribute is not valid.');
        }
    }

    private function validateCardNumber($cardNumber): bool
    {
        if (empty($cardNumber) || strlen($cardNumber) !== 16) {
            return false;
        }

        $cardToArray = str_split($cardNumber);
        $cardTotal = 0;
        foreach ($cardToArray as $key => $value) {
            if ($key % 2 === 0) {
                $cardTotal += (($value * 2 > 9) ? ($value * 2) - 9 : ($value * 2));
            } else {
                $cardTotal += $value;
            }
        }

        return ($cardTotal % 10 === 0);
    }
}
