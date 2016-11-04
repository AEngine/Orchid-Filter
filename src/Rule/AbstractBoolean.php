<?php

namespace AEngine\Orchid\Filter\Rule;

abstract class AbstractBoolean
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
