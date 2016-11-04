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
        return function ($field) use ($min, $max) {
            if (!is_scalar($field)) {
                return false;
            }
            $len = mb_strlen($field);

            return ($len >= $min && $len <= $max);
        };
    }
}
