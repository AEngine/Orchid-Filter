<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class InValues
{
    /**
     * Validates that the value is in a given array
     *
     * @param array $array array of allowed values
     *
     * @return Closure
     */
    public function __invoke(array $array)
    {
        return function ($data, $field) use ($array) {
            return in_array($data[$field], $array, true);
        };
    }
}
