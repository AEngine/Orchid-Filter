<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use AEngine\Orchid\Filter\Rule\AbstractBoolean;
use Closure;

class Boolean extends AbstractBoolean
{
    /**
     * Sanitize the value to a boolean, or a pseudo-boolean
     *
     * @param mixed $true  Use this value for `true`
     * @param mixed $false Use this value for `false`
     *
     * @return Closure
     */
    public function __invoke($true = true, $false = false)
    {
        return function (&$field) use ($true, $false) {
            if ($this->isTrue($field)) {
                $field = $true;

                return true;
            }

            if ($this->isFalse($field)) {
                $field = $false;

                return true;
            }

            $field = $field ? $true : $false;
            return true;
        };
    }
}
