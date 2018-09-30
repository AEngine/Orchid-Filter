<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Trim extends FilterAnnotation
{
    /**
     * @var string
     */
    public $chars;

    /**
     * Validates that a value is already trimmed
     *
     * @param string $chars characters to strip
     */
    public function __construct($chars = " \t\n\r\0\x0B")
    {
        $this->replace([
            'chars' => $chars,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return trim($value, $this->chars) == $value;
    }
}
