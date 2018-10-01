<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class StrlenMax extends FilterAnnotation
{
    /**
     * @var integer
     */
    public $max;

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $max value must have no more than this many
     */
    public function __construct($max)
    {
        $this->replace([
            'max' => $max,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return mb_strlen($value) <= $this->max;
    }
}
