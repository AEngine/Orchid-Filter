<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

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
     * Sanitizes to maximum value if value is greater than max
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
        $value = &$data[$field];

        if (!is_scalar($value)) {
            return false;
        }
        if ($value > $this->max) {
            $value = $this->max;
        }

        return true;
    }
}
