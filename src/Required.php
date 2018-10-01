<?php

namespace AEngine\Orchid\Filter;

use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Required extends FilterAnnotation
{
    public function __invoke(&$data, $field)
    {
        return !!$data[$field];
    }
}
