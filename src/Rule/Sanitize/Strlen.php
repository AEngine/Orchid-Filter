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
        return function (&$data, $field) use ($len, $padString, $padType) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $strlen = mb_strlen($value);

            if ($strlen < $len) {
                $value = $this->mbStrPad($value, $len, $padString, $padType);
            }
            if ($strlen > $len) {
                $value = mb_substr($value, 0, $len);
            }

            return true;
        };
    }
}
