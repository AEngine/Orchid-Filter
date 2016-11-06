<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class StrReplace
{
    /**
     * Forces the value to a string, optionally applying `str_replace()`
     *
     * @param string|array $find    Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     *
     * @return Closure
     */
    public function __invoke($find = null, $replace = null)
    {
        return function (&$data, $field) use ($find, $replace) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($find || $replace) {
                $value = str_replace($find, $replace, $value);
            }

            return true;
        };
    }
}
