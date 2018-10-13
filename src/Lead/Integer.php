<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Integer extends FilterRule
{
    /**
     * Forces the value to an integer
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (is_numeric($value) || is_string($value)) {
            $value = (float)$value;
            $value = (int)$value;

            return true;
        }

        return false;
    }
}
