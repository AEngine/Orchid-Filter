<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class EqualToValue
{
    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $other_value other value
     *
     * @return Closure
     */
    public function __invoke($other_value)
    {
        return function ($field) use ($other_value) {
            return $field == $other_value;
        };
    }
}
