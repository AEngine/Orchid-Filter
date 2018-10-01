<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Min extends FilterAnnotation
{
    /**
     * @var integer
     */
    public $min;

    /**
     * Validates that the value is greater than or equal to a minimum
     *
     * @param int $min minimum valid value
     */
    public function __construct($min)
    {
        $this->replace([
            'min' => $min,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return $value >= $this->min;
    }
}
