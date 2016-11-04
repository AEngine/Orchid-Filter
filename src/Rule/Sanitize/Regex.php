<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Regex
{
    /**
     * Applies `preg_replace()` to the value
     *
     * @param string $expr    regular expression pattern to apply
     * @param string $replace Replace the found pattern with this string
     *
     * @return Closure
     */
    public function __invoke($expr, $replace)
    {
        return function (&$data, $field) use ($expr, $replace) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = preg_replace($expr, $replace, $value);

            return true;
        };
    }
}
