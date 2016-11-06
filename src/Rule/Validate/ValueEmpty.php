<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class ValueEmpty
{
    /**
     * Validates that the value is Empty
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            return empty($data[$field]);
        };
    }
}
