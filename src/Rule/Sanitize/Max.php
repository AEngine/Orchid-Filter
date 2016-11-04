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
        return function (&$data, $field) use ($max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value > $max) {
                $value = $max;
            }

            return true;
        };
    }
}
