<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Strlen
{
    /**
     * Sanitizes a string to an exact length by padding or chopping it
     *
     * @param int    $min       minimum string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function Strlen($min, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$field) use ($min, $padString, $padType) {
            if (!is_scalar($field)) {
                return false;
            }

            $strlen = mb_strlen($field);

            if ($strlen < $min) {
                $field = $this->mb_str_pad($field, $min, $padString, $padType);
            }
            if ($strlen > $min) {
                $field = mb_substr($field, 0, $min);
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
     * Note: some function in StrlenMin
     *
     * @return string
     */
    protected function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $diff = strlen($input) - mb_strlen($input);

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }
}