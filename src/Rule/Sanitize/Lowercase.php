<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Lowercase
{
    /**
     * Sanitizes a string to lowercase
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = strtolower($value);

            return true;
        };
    }
}
