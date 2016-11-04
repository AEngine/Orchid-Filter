<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use AEngine\Orchid\Filter\Rule\AbstractStrlen;
use Closure;

class StrlenBetween extends AbstractStrlen
{
    /**
     * Sanitizes a string to a length range by padding or chopping it
     *
     * @param int    $min       minimum length
     * @param int    $max       maximum length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function __invoke($min, $max, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$field) use ($min, $max, $padString, $padType) {
            if (!is_scalar($field)) {
                return false;
            }
            if (mb_strlen($field) < $min) {
                $field = $this->mb_str_pad($field, $min, $padString, $padType);;
            }
            if (mb_strlen($field) > $max) {
                $field = mb_substr($field, 0, $max);
            }

            return true;
        };
    }
}
