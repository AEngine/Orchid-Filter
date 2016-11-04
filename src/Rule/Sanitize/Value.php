<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Value
{
    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     *
     * @return Closure
     */
    public function __invoke($otherValue)
    {
        return function (&$data, $field) use ($otherValue) {
            $data[$field] = $otherValue;

            return true;
        };
    }
}
