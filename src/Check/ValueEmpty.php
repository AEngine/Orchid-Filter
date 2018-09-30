<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class ValueEmpty extends FilterAnnotation
{
    /**
     * Validates that the value is Empty
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return empty($data[$field]);
    }
}
