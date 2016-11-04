<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use AEngine\Orchid\Filter\Rule\AbstractStrlen;
use Closure;

class StrlenMin extends AbstractStrlen
{
    /**
     * Sanitizes a string to a minimum length by padding it
     *
     * @param int    $min       string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function __invoke($min, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$data, $field) use ($min, $padString, $padType) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if (mb_strlen($value) < $min) {
                $value = $this->mb_str_pad($value, $min, $padString, $padType);;
            }

            return true;
        };
    }
}
