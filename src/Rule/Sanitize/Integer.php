<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Integer
{
    /**
     * Forces the value to an integer
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$field) {
            if (is_numeric($field) || is_string($field)) {
                $field = (float)$field;
                $field = (int)$field;

                return true;
            }

            return false;
        };
    }
}
