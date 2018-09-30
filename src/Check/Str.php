<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Str extends FilterAnnotation
{
    /**
     * Validates that the value represents a string
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return is_string($data[$field]);
    }
}
