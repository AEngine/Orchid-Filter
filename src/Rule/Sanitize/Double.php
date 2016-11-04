<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Double
{
    /**
     * Forces the value to a float
     *
     * @param int $precision rounding precision
     *
     * @return Closure
     */
    public function __invoke($precision = 0)
    {
        return function (&$field) use ($precision) {
            if (is_numeric($field) || is_string($field)) {
                $field = round((double)$field, $precision);

                return true;
            }

            return false;
        };
    }
}
