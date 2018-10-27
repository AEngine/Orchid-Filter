<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Double extends FilterRule
{
    /**
     * @var integer
     */
    public $precision;

    /**
     * Forces the value to a float
     *
     * @param int $precision rounding precision
     */
    public function __construct($precision = 2)
    {
        $this->replace([
            'precision' => $precision,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (is_numeric($value) || is_string($value)) {
            $value = round((double)$value, $this->precision);

            return true;
        }

        return false;
    }
}
