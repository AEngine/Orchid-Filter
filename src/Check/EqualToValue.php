<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class EqualToValue extends FilterAnnotation
{
    /**
     * @var string
     */
    public $otherValue;

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $otherValue other value
     */
    public function __construct($otherValue)
    {
        $this->replace([
            'otherValue' => $otherValue,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        return $data[$field] == $this->otherValue;
    }
}
