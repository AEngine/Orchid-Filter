<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Between
{
    /**
     * If the value is less than min, will set the min value,
     * and if value is greater than max, set the max value
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function __invoke($min, $max)
    {
        return function (&$field) use ($min, $max) {
            if (!is_scalar($field)) {
                return false;
            }
            if ($field < $min) {
                $field = $min;
            }
            if ($field > $max) {
                $field = $max;
            }

            return true;
        };
    }
}
