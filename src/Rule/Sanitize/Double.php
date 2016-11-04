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
        return function (&$data, $field) use ($precision) {
            $value = &$data[$field];
            if (is_numeric($value) || is_string($value)) {
                $value = round((double)$value, $precision);

                return true;
            }

            return false;
        };
    }
}
