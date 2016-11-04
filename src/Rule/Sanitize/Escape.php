<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Escape
{
    /**
     * Sanitizes escapes a string
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$field) {
            if (is_string($field)) {
                $field = str_replace(
                    ['\'', '"', '>', '<', '`', '\\'],
                    ['&#039;', '&#34;', '&#62;', '&#60;', '&#96;', '&#92;'],
                    $field
                );
            }

            return true;
        };
    }
}
