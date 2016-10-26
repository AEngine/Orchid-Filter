<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Str
{
    /**
     * Forces the value to a string, optionally applying `str_replace()`
     *
     * @param string|array $find    Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     *
     * @return Closure
     */
    public function Str($find = null, $replace = null)
    {
        return function (&$field) use ($find, $replace) {
            if (!is_scalar($field)) {
                return false;
            }
            if ($find || $replace) {
                $field = str_replace($find, $replace, $field);
            }

            return true;
        };
    }
}
