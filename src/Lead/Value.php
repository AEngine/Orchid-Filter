<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Value extends FilterAnnotation
{
    /**
     * @var mixed
     */
    public $otherValue;

    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     */
    public function __construct($otherValue)
    {
        $this->replace([
            'otherValue' => $otherValue,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $data[$field] = $this->otherValue;

        return true;
    }
}
