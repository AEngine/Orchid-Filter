<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class InValues extends FilterAnnotation
{
    /**
     * @var array
     */
    public $array;

    /**
     * Validates that the value is in a given array
     *
     * @param array $array array of allowed values
     */
    public function __construct($array)
    {
        $this->replace([
            'array' => $array,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        return in_array($data[$field], $this->array, true);
    }
}
