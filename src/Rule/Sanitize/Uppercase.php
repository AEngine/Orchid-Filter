<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Uppercase
{
    /**
     * Sanitizes a string to uppercase
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = strtoupper($value);

            return true;
        };
    }
}
