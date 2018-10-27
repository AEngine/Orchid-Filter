<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Boolean extends FilterRule
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
