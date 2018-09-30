<?php

namespace AEngine\Orchid\Filter;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Required extends FilterAnnotation
{
    public function __invoke(&$data, $field)
    {
        return !!$data[$field];
    }
}
