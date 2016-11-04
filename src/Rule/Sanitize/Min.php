<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Min
{
    /**
     * Sanitizes to minimum value if value is less than min
     *
     * @param int $min minimum valid value
     *
     * @return Closure
     */
    public function __invoke($min)
    {
        return function (&$data, $field) use ($min) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value < $min) {
                $value = $min;
            }

            return true;
        };
    }
}
