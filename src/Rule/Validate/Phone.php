<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Phone
{
    /**
     * Validates that the value is phone
     *
     * @return Closure
     */
    public function __invoke()
    {
        $pattern = '\(?\+[0-9]{1,3}\)? ?-?[0-9]{1,3} ?-?[0-9]{3,5} ?-?[0-9]{4}( ?-?[0-9]{3})? ?(\w{1,10}\s?\d{1,6})?';

        return function ($data, $field) use ($pattern) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            if (preg_match($pattern, $value)) {
                return true;
            }

            return false;
        };
    }
}