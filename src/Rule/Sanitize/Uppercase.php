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
        return function (&$field) {
            if (!is_scalar($field)) {
                return false;
            }

            $field = strtoupper($field);

            return true;
        };
    }
}
