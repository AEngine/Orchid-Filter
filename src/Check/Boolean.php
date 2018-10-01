<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Boolean extends FilterAnnotation
{
    /**
     * Validates that the value is a boolean representation
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return static::isTrue($data[$field]) || static::isFalse($data[$field]);
    }
}
