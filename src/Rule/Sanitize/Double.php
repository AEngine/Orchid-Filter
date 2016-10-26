<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Double
{
    /**
     * Forces the value to a float
     *
     * @param int $precision rounding precision
     *
     * @return Closure
     */
    public function Double($precision = 0)
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