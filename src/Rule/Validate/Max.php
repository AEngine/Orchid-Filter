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
        return function ($field) use ($max) {
            if (!is_scalar($field)) {
                return false;
            }

            return $field <= $max;
        };
    }
}
