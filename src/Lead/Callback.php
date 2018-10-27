<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Callback extends FilterRule
{
    /**
     * Sanitizes a value using a callable
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        return $data[$field]($data, $field);
    }
}
