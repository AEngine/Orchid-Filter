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
        return function (&$data, $field) use ($true, $false) {
            $value = &$data[$field];
            if ($this->isTrue($value)) {
                $value = $true;

                return true;
            }

            if ($this->isFalse($value)) {
                $value = $false;

                return true;
            }

            $value = $value ? $true : $false;
            return true;
        };
    }
}
