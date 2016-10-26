<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use AEngine\Orchid\Filter\Validate\Rule\BooleanHelper;
use Closure;

trait Boolean
{
    use BooleanHelper;

    /**
     * Sanitize the value to a boolean, or a pseudo-boolean
     *
     * @param mixed $true  Use this value for `true`
     * @param mixed $false Use this value for `false`
     *
     * @return Closure
     */
    public function Boolean($true = true, $false = false)
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

            return $field ? $true : $false;
        };
    }
}
