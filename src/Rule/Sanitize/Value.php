<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Value
{
    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     *
     * @return Closure
     */
    public function Value($otherValue)
    {
        return function (&$field) use ($otherValue) {
            $field = $otherValue;

            return true;
        };
    }
}