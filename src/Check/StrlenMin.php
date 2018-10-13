<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class StrlenMin extends FilterRule
{
    /**
     * @var integer
     */
    public $min;

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $min value must have at least this many characters
     */
    public function __construct($min)
    {
        $this->replace([
            'min' => $min,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return mb_strlen($value) >= $this->min;
    }
}
