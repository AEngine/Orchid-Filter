<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Lowercase
{
    /**
     * Sanitizes a string to lowercase
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$field) {
            if (!is_scalar($field)) {
                return false;
            }

            $field = strtolower($field);

            return true;
        };
    }
}
