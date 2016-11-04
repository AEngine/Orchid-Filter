<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class StrlenMin
{
    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $min value must have at least this many characters
     *
     * @return Closure
     */
    public function __invoke($min)
    {
        return function ($field) use ($min) {
            if (!is_scalar($field)) {
                return false;
            }

            return mb_strlen($field) >= $min;
        };
    }
}
