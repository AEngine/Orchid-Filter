<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
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
