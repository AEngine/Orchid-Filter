<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Str
{
    /**
     * Validates that the value represents a string
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            return is_string($data[$field]);
        };
    }
}
