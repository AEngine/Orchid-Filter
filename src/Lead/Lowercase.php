<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Lowercase extends FilterAnnotation
{
    /**
     * Sanitizes a string to lowercase
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        $value = strtolower($value);

        return true;
    }
}
