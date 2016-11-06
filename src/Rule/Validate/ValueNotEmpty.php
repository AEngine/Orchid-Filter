<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class ValueNotEmpty
{
    /**
     * Validates that the value is *not* Empty
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            return !empty($data[$field]);
        };
    }
}
