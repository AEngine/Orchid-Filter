<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Max
{
    /**
     * Sanitizes to maximum value if value is greater than max
     *
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function __invoke($max)
    {
        return function (&$field) use ($max) {
            if (!is_scalar($field)) {
                return false;
            }
            if ($field > $max) {
                $field = $max;
            }

            return true;
        };
    }
}
