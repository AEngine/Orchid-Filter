<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Str
{
    /**
     * Forces the value to a string
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value) || !method_exists($value, '__toString')) {
                return false;
            }

            $value = strval($value);

            return false;
        };
    }
}
