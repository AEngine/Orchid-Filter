<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Callback
{
    /**
     * Sanitizes a value using a callable
     *
     * @return Closure
     */
    public function Callback()
    {
        return function (callable $field) {
            return $field();
        };
    }
}
