<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Word extends FilterAnnotation
{
    /**
     * Strips non-word characters within the value (letters, numbers, and underscores)
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

        $value = preg_replace('/[^\p{L}\p{Nd}_]/u', '', $value);

        return true;
    }
}
