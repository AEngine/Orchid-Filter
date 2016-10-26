<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use AEngine\Orchid\Filter\Validate\Rule\StrlenHelper;
use Closure;

trait Strlen
{
    use StrlenHelper;

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
}
