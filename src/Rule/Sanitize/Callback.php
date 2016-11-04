<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Callback
{
    /**
     * Sanitizes a value using a callable
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (callable $field) {
            return $field();
        };
    }
}
