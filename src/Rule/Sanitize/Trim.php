<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Trim
{
    /**
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     *
     * @return Closure
     */
    public function Trim($chars = " \t\n\r\0\x0B")
    {
        return function (&$field) use ($chars) {
            if (is_scalar($field) || $field === null) {
                $field = trim($field, $chars);

                return true;
            }

            return false;
        };
    }
}
