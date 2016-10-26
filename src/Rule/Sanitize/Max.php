<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Max
{
    /**
     * Sanitizes to maximum value if value is greater than max
     *
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function Max($max)
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
