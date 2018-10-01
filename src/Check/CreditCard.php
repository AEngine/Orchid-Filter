<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class CreditCard extends FilterAnnotation
{
    /**
     * Validates the value as a credit card number
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        // get the value; remove spaces, dashes, and dots
        $value = str_replace([' ', '-', '.'], '', (string)$value);

        // is it composed only of digits?
        if (!ctype_digit($value)) {
            return false;
        }

        // luhn mod-10 algorithm: https://gist.github.com/1287893
        $sumTable = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [0, 2, 4, 6, 8, 1, 3, 5, 7, 9],
        ];

        $sum  = 0;
        $flip = 0;

        for ($i = strlen($value) - 1; $i >= 0; $i--) {
            $sum += $sumTable[$flip++ & 0x1][$value[$i]];
        }

        return $sum % 10 === 0;
    }
}
