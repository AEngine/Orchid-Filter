<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Str extends FilterRule
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
