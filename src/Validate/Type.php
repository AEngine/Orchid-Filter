<?php

namespace AEngine\Filter\Validate;

use Closure;

trait Type
{
    /**
     * Checked value should be empty
     *
     * @return Closure
     */
    public function isEmpty()
    {
        return function ($field) {
            return empty($field);
        };
    }

    /**
     * Checked value should not be empty
     *
     * @return Closure
     */
    public function isNotEmpty()
    {
        return function ($field) {
            return !empty($field);
        };
    }

    /**
     * Checked value should be of type Boolean
     *
     * @return Closure
     */
    public function isBoolean()
    {
        return function ($field) {
            return is_bool($field);
        };
    }

    /**
     * Checked value should be a number
     *
     * @return Closure
     */
    public function isNumeric()
    {
        return function ($field) {
            return is_numeric($field);
        };
    }

    /**
     * Checked value should be a string
     *
     * @return Closure
     */
    public function isString()
    {
        return function ($field) {
            return is_string($field);
        };
    }
}
