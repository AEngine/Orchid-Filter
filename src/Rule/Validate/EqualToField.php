<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class EqualToField
{
    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $other_field Check against the value of this subject field
     *
     * @return Closure
     */
    public function __invoke($other_field)
    {
        return function ($data, $field) use ($other_field) {
            // the other field needs to exist and *not* be null
            if (!isset($data[$other_field])) {
                return false;
            }

            return $data[$field] == $data[$other_field];
        };
    }
}
