<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use AEngine\Orchid\Filter\Rule\AbstractBoolean;
use Closure;

class Boolean extends AbstractBoolean
{
    /**
     * Validates that the value is a boolean representation
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($field) {
            return $this->isTrue($field) || $this->isFalse($field);
        };
    }
}
