<?php

namespace AEngine\Orchid\Filter;

use AEngine\Orchid\Annotations\Annotation;

abstract class FilterAnnotation extends Annotation
{
    // error message
    public $message;

    /**
     * Pseudo-true representations.
     *
     * @var array
     */
    protected static $true = ['1', 'on', 'true', 't', 'yes', 'y'];

    /**
     * Pseudo-false representations; `null` and empty-string are *not* included.
     *
     * @var array
     */
    protected static $false = ['0', 'off', 'false', 'f', 'no', 'n'];

    /**
     * Invoked method
     *
     * @param $data
     * @param $field
     *
     * @return mixed
     */
    abstract public function __invoke(&$data, $field);

    /**
     * @param $value
     *
     * @return bool
     */
    protected static function isTrue($value)
    {
        if (!static::isBoolish($value)) {
            return false;
        }

        return $value === true || in_array(strtolower(trim($value)), static::$true);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    protected static function isFalse($value)
    {
        if (!static::isBoolish($value)) {
            return false;
        }

        return $value === false || in_array(strtolower(trim($value)), static::$false);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    protected static function isBoolish($value)
    {
        if (is_string($value) || is_int($value) || is_bool($value)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $input
     * @param int    $pad_length
     * @param string $pad_string
     * @param int    $pad_type
     *
     * @return string
     */
    protected static function mbStrPad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $diff = strlen($input) - mb_strlen($input);

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }
}
