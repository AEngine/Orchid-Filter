<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Regex
{
    /**
     * Applies `preg_replace()` to the value
     *
     * @param string $expr    The regular expression pattern to apply
     * @param string $replace Replace the found pattern with this string
     *
     * @return Closure
     */
    public function Regex($expr, $replace)
    {
        return function (&$field) use ($expr, $replace) {
            if (!is_scalar($field)) {
                return false;
            }

            $field = preg_replace($expr, $replace, $field);

            return true;
        };
    }
}