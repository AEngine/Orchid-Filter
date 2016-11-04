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
        return function ($data, $field) use ($min) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return $value >= $min;
        };
    }
}
