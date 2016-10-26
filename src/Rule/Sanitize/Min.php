<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Min
{
    /**
     * Sanitizes to minimum value if value is less than min
     *
     * @param int $min minimum valid value
     *
     * @return Closure
     */
    public function Min($min)
    {
        return function (&$field) use ($min) {
            if (!is_scalar($field)) {
                return false;
            }
            if ($field < $min) {
                $field = $min;
            }

            return true;
        };
    }
}