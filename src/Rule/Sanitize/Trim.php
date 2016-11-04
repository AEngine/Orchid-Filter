<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Trim
{
    /**
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     *
     * @return Closure
     */
    public function __invoke($chars = " \t\n\r\0\x0B")
    {
        return function (&$data, $field) use ($chars) {
            $value = &$data[$field];
            if (is_scalar($value) || $value === null) {
                $value = trim($value, $chars);

                return true;
            }

            return false;
        };
    }
}
