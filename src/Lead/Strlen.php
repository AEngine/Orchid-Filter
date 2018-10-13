<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Strlen extends FilterRule
{
    /**
     * @var integer
     */
    public $len;

    /**
     * @var string
     */
    public $padString;

    /**
     * @var integer
     */
    public $padType;

    /**
     * Sanitizes a string to an exact length by padding or chopping it
     *
     * @param int    $len       minimum string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     */
    public function __construct($len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        $this->replace([
            'len' => $len,
            'padString' => $padString,
            'padType' => $padType,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        $strLen = mb_strlen($value);

        if ($strLen < $this->len) {
            $value = static::mbStrPad($value, $this->len, $this->padString, $this->padType);
        }
        if ($strLen > $this->len) {
            $value = mb_substr($value, 0, $this->len);
        }

        return true;
    }
}
