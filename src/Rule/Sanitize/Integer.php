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
        return function (&$data, $field) {
            $value = &$data[$field];
            if (is_numeric($value) || is_string($value)) {
                $value = (float)$value;
                $value = (int)$value;

                return true;
            }

            return false;
        };
    }
}
