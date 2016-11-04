<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class StrlenMax
{
    /**
     * Sanitizes a string to a maximum length by chopping it at the right
     *
     * @param int $max maximum length.
     *
     * @return Closure
     */
    public function __invoke($max)
    {
        return function (&$data, $field) use ($max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if (mb_strlen($value) > $max) {
                $value = mb_substr($value, 0, $max);
            }

            return true;
        };
    }
}
