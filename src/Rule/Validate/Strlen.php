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
        return function ($field) use ($len) {
            if (!is_scalar($field)) {
                return false;
            }

            return mb_strlen($field) == $len;
        };
    }
}
