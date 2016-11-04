<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Max
{
    /**
     * Validates that the value is less than than or equal to a maximum
     *
     * @param string $max maximum valid value
     *
     * @return Closure
     */
    public function __invoke($max)
    {
        return function ($data, $field) use ($max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return $value <= $max;
        };
    }
}
