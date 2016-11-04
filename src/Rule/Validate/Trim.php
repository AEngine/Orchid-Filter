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
        return function ($data, $field) use ($chars) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return trim($value, $chars) == $value;
        };
    }
}
