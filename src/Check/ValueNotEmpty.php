<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class ValueNotEmpty extends FilterRule
{
    /**
     * Validates that the value is *not* Empty
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return !empty($data[$field]);
    }
}
