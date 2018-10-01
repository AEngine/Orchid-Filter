<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Callback extends FilterAnnotation
{
    /**
     * Sanitizes a value using a callable
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return $data[$field]($data, $field);
    }
}
