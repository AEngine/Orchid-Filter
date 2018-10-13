<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Remove extends FilterRule
{
    /**
     * Removes the field from the data with unset()
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        unset($data[$field]);

        return true;
    }
}
