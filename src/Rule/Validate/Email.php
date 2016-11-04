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
        return function ($field) {
            return !!filter_var($field, FILTER_VALIDATE_EMAIL);
        };
    }
}
