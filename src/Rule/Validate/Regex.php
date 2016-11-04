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
        return function ($data, $field) use ($expr) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return (bool)preg_match($expr, $value);
        };
    }
}
