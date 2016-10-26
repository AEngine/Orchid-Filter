<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Escape
{
    /**
     * Sanitizes escapes a string
     *
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function Escape($max)
    {
        return function (&$field) use ($max) {
            if (!is_scalar($field)) {
                return false;
            }
            $field = str_replace(
                ['\'', '"', '>', '<', '`', '\\'],
                ['&#039;', '&#34;', '&#62;', '&#60;', '&#96;', '&#92;'],
                $field
            );

            return true;
        };
    }
}