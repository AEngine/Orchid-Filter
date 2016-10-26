<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Lowercase
{
    /**
     * Sanitizes a string to lowercase
     *
     * @return Closure
     */
    public function Lowercase()
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