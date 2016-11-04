<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class CreditCard
{
    /**
     * Validates the value as a credit card number
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($field) {
            // get the value; remove spaces, dashes, and dots
            $field = str_replace([' ', '-', '.'], '', (string)$field);

            // is it composed only of digits?
            if (!ctype_digit($field)) {
                return false;
            }

            // luhn mod-10 algorithm: https://gist.github.com/1287893
            $sumTable = [
                [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                [0, 2, 4, 6, 8, 1, 3, 5, 7, 9],
            ];

            $sum = 0;
            $flip = 0;

            for ($i = strlen($field) - 1; $i >= 0; $i--) {
                $sum += $sumTable[$flip++ & 0x1][$field[$i]];
            }

            return $sum % 10 === 0;
        };
    }
}
