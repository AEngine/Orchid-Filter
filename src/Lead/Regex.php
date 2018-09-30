<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotation\AnnotationTarget;

/**
 * @AnnotationTarget('PROPERTY')
 */
class Regex extends FilterAnnotation
{
    /**
     * @var string
     */
    public $expr;

    /**
     * @var string
     */
    public $replace;

    /**
     * Applies `preg_replace()` to the value
     *
     * @param string $expr    regular expression pattern to apply
     * @param string $replace Replace the found pattern with this string
     */
    public function __construct($expr, $replace)
    {
        $this->replace([
            'expr' => $expr,
            'replace' => $replace,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        $value = preg_replace($this->expr, $this->replace, $value);

        return true;
    }
}
