<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use AEngine\Orchid\Filter\Validate\Rule\StrlenHelper;
use Closure;

trait StrlenMin
{
    use StrlenHelper;

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
}
