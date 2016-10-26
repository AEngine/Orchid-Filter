<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait StrlenMin
{
    /**
     * Sanitizes a string to a minimum length by padding it
     *
     * @param int    $len       string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function StrlenMin($len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$field) use ($len, $padString, $padType) {
            if (!is_scalar($field)) {
                return false;
            }
            if (mb_strlen($field) < $len) {
                $field = $this->mb_str_pad($field, $len, $padString, $padType);;
            }

            return true;
        };
    }

    /**
     * @param string $input
     * @param int    $pad_length
     * @param string $pad_string
     * @param int    $pad_type
     *
     * Note: some function in Strlen
     *
     * @return string
     */
    protected function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $diff = strlen($input) - mb_strlen($input);

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }
}