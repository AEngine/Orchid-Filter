<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Integer extends FilterAnnotation
{
    /**
     * Validates that the value represents an integer
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (is_int($value)) {
            return true;
        }

        // otherwise, must be numeric, and must be same as when cast to int
        return is_numeric($value) && $value == (int)$value;
    }
}
