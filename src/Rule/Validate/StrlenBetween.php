<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class StrlenBetween
{
    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $min minimum valid length.
     * @param int $max maximum valid length.
     *
     * @return Closure
     */
    public function __invoke($min, $max)
    {
        return function ($data, $field) use ($min, $max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            $len = mb_strlen($value);

            return ($len >= $min && $len <= $max);
        };
    }
}
