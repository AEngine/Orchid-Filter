<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Regex extends FilterAnnotation
{
    /**
     * @var integer
     */
    public $expr;

    /**
     * Validates the value against a regular expression
     *
     * @param string $expr regular expression pattern to apply
     */
    public function __construct($expr)
    {
        $this->replace([
            'expr' => $expr,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return (bool)preg_match($this->expr, $value);
    }
}
