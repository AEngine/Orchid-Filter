<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Min
{
    /**
     * Validates that the value is greater than or equal to a minimum
     *
     * @param string $min minimum valid value
     *
     * @return Closure
     */
    public function __invoke($min)
    {
        return function ($field) use ($min) {
            if (!is_scalar($field)) {
                return false;
            }

            return $field >= $min;
        };
    }
}
