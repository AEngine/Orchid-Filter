<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Integer
{
    /**
     * Validates that the value represents an integer
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            $value = $data[$field];
            if (is_int($value)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to int
            return is_numeric($value) && $value == (int)$value;
        };
    }
}
