<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Max extends FilterRule
{
    /**
     * @var integer
     */
    public $max;

    /**
     * Validates that the value is less than than or equal to a maximum
     *
     * @param int $max maximum valid value
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

        return $value <= $this->max;
    }
}
