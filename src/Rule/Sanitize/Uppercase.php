<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Uppercase
{
    /**
     * Sanitizes a string to uppercase
     *
     * @return Closure
     */
    public function Uppercase()
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