<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Between
{
    /**
     * Validates that the value is within a given range
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function __invoke($min, $max)
    {
        return function (&$data, $field) use ($min, $max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return ($value >= $min && $value <= $max);
        };
    }
}
