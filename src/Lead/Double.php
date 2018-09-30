<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Double extends FilterAnnotation
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
    public function __construct($precision)
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
