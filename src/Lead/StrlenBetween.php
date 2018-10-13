<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class StrlenBetween extends FilterRule
{
    /**
     * @var integer
     */
    public $min;

    /**
     * @var integer
     */
    public $max;

    /**
     * @var string
     */
    public $padString;

    /**
     * @var integer
     */
    public $padType;

    /**
     * Sanitizes a string to a length range by padding or chopping it
     *
     * @param int    $min       minimum length
     * @param int    $max       maximum length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     */
    public function __construct($min, $max, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        $this->replace([
            'min' => $min,
            'max' => $max,
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
        if (mb_strlen($value) < $this->min) {
            $value = static::mbStrPad($value, $this->min, $this->padString, $this->padType);;
        }
        if (mb_strlen($value) > $this->max) {
            $value = mb_substr($value, 0, $this->max);
        }

        return true;
    }
}
