<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Between extends FilterAnnotation
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
     * Validates that the value is within a given range
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     */
    public function __construct($min, $max)
    {
        $this->replace([
            'min' => $min,
            'max' => $max,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return ($value >= $this->min && $value <= $this->max);
    }
}
