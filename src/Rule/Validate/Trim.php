<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Trim
{
    /**
     * Validates that a value is already trimmed
     *
     * @param string $chars characters to strip
     *
     * @return Closure
     */
    public function __invoke($chars = " \t\n\r\0\x0B")
    {
        return function ($field) use ($chars) {
            if (!is_scalar($field)) {
                return false;
            }

            return trim($field, $chars) == $field;
        };
    }
}
