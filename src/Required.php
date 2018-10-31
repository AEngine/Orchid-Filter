<?php

namespace AEngine\Orchid\Filter;

use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Required extends FilterRule
{
    public function __invoke(&$data, $field)
    {
        return true;
    }
}
