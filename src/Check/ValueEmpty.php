<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class ValueEmpty extends FilterRule
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
