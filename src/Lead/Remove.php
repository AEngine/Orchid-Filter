<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Remove extends FilterAnnotation
{
    /**
     * Removes the field from the data with unset()
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        unset($data[$field]);

        return true;
    }
}
