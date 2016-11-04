<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Email
{
    /**
     * Validates that the value is an email address
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            return !!filter_var($data[$field], FILTER_VALIDATE_EMAIL);
        };
    }
}
