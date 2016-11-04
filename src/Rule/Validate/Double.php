<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Double
{
    /**
     * Validates that the value represents a float
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($field) {
            if (is_float($field)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to float
            return is_numeric($field) && $field == (float)$field;
        };
    }
}
