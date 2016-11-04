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
        return function (&$data, $field) {
            $value = &$data[$field];
            if (is_string($value)) {
                $value = str_replace(
                    ['\'', '"', '>', '<', '`', '\\'],
                    ['&#039;', '&#34;', '&#62;', '&#60;', '&#96;', '&#92;'],
                    $value
                );
            }

            return true;
        };
    }
}
