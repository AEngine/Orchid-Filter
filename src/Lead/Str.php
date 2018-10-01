<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;

class Str extends FilterAnnotation
{
    /**
     * Forces the value to a string
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (!is_scalar($value) || !method_exists($value, '__toString')) {
            return false;
        }

        $value = strval($value);

        return true;
    }
}
