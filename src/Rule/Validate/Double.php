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
        return function ($data, $field) {
            $value = $data[$field];
            if (is_float($value)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to float
            return is_numeric($value) && $value == (float)$value;
        };
    }
}
