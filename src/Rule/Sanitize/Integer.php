<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Integer
{
    /**
     * Forces the value to an integer
     *
     * @return Closure
     */
    public function Integer()
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