<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Strlen
{
    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $len valid length
     *
     * @return Closure
     */
    public function __invoke($len)
    {
        return function ($data, $field) use ($len) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return mb_strlen($value) == $len;
        };
    }
}
