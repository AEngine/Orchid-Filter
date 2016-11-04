<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use AEngine\Orchid\Filter\Rule\AbstractStrlen;
use Closure;

class Strlen extends AbstractStrlen
{
    /**
     * Sanitizes a string to an exact length by padding or chopping it
     *
     * @param int    $len       minimum string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function __invoke($len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$field) use ($len, $padString, $padType) {
            if (!is_scalar($field)) {
                return false;
            }

            $strlen = mb_strlen($field);

            if ($strlen < $len) {
                $field = $this->mb_str_pad($field, $len, $padString, $padType);
            }
            if ($strlen > $len) {
                $field = mb_substr($field, 0, $len);
            }

            return true;
        };
    }
}
