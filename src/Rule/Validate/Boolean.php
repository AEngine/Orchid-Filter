<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Validate;

use AEngine\Orchid\Filter\Validate\Rule\BooleanHelper;
use Closure;

trait Boolean
{
    use BooleanHelper;

    /**
     * Validates that the value is a boolean representation
     *
     * @return Closure
     */
    public function Boolean()
    {
        return function (&$field) {
            return $this->isTrue($field) || $this->isFalse($field);
        };
    }
}