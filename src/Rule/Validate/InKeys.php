<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class InKeys
{
    /**
     * Validates that the value is a key in a given array
     *
     * @param array $array array of key-value pairs; the value must match
     *                     one of the keys in this array
     *
     * @return Closure
     */
    public function __invoke(array $array)
    {
        return function ($data, $field) use ($array) {
            $value = $data[$field];
            if (!is_string($value) && !is_int($value)) {
                // array_key_exists errors on non-string non-int keys.
                return false;
            }

            // using array_keys() converts string numeric keys to integers, which
            // is *not* the behavior we want.
            return array_key_exists($value, $array);
        };
    }
}
