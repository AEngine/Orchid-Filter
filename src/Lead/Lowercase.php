<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Lowercase extends FilterRule
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
