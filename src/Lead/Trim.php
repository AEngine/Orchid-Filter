<?php

namespace AEngine\Orchid\Filter\Lead;

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
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     */
    public function __construct($chars = " \t\n\r\0\x0B")
    {
        $this->replace([
            'chars' => $chars,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (is_scalar($value) || $value === null) {
            $value = trim($value, $this->chars);

            return true;
        }

        return false;
    }
}
