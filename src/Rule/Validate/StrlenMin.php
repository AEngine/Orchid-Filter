<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class StrlenMin
{
    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $min value must have at least this many characters
     *
     * @return Closure
     */
    public function __invoke($min)
    {
        return function ($data, $field) use ($min) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return mb_strlen($value) >= $min;
        };
    }
}
