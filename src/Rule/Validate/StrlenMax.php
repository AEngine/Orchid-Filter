<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class StrlenMax
{
    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $max value must have no more than this many
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

            return mb_strlen($value) <= $max;
        };
    }
}
