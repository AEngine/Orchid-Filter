<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class StrictEqualToField extends FilterAnnotation
{
    /**
     * @var string
     */
    public $otherField;

    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $otherField Check against the value of this subject field
     */
    public function __construct($otherField)
    {
        $this->replace([
            'otherField' => $otherField,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        // the other field needs to exist and *not* be null
        if (!isset($data[$this->otherField])) {
            return false;
        }

        return $data[$field] === $data[$this->otherField];
    }
}