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
        return function (&$data, $field) use ($min, $max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value < $min) {
                $value = $min;
            }
            if ($value > $max) {
                $value = $max;
            }

            return true;
        };
    }
}
