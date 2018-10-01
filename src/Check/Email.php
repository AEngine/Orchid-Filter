<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Email extends FilterAnnotation
{
    /**
     * Validates that the value represents a float
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return !!filter_var($data[$field], FILTER_VALIDATE_EMAIL);
    }
}
