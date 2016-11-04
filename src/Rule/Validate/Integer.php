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
        return function ($field) {
            if (is_int($field)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to int
            return is_numeric($field) && $field == (int)$field;
        };
    }
}
