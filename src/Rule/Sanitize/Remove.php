<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Remove
{
    /**
     * Removes the field from the data with unset()
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$data, $field) {
            unset($data[$field]);

            return true;
        };
    }
}