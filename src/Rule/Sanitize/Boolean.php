<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Boolean
{
    /**
     * Pseudo-true representations.
     *
     * @var array
     */
    protected $true = ['1', 'on', 'true', 't', 'yes', 'y'];

    /**
     * Pseudo-false representations; `null` and empty-string are *not* included.
     *
     * @var array
     */
    protected $false = ['0', 'off', 'false', 'f', 'no', 'n'];

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

    protected function isTrue($value)
    {
        if (!$this->isBoolish($value)) {
            return false;
        }

        return $value === true || in_array(strtolower(trim($value)), $this->true);
    }

    protected function isFalse($value)
    {
        if (!$this->isBoolish($value)) {
            return false;
        }

        return $value === false || in_array(strtolower(trim($value)), $this->false);
    }

    protected function isBoolish($value)
    {
        if (is_string($value) || is_int($value) || is_bool($value)) {
            return true;
        }

        return false;
    }
}