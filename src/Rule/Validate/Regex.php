<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Regex
{
    /**
     * Validates the value against a regular expression
     *
     * @param string $expr regular expression pattern to apply
     *
     * @return Closure
     */
    public function __invoke($expr)
    {
        return function ($field) use ($expr) {
            if (!is_scalar($field)) {
                return false;
            }

            return (bool)preg_match($expr, $field);
        };
    }
}
