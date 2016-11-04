<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class StrictEqualToValue
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
        return function ($data, $field) use ($other_value) {
            return $data[$field] === $other_value;
        };
    }
}
