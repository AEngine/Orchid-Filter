<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class EqualToValue extends FilterRule
{
    /**
     * @var string
     */
    public $otherValue;

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $otherValue other value
     */
    public function __construct($otherValue)
    {
        $this->replace([
            'otherValue' => $otherValue,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        return $data[$field] == $this->otherValue;
    }
}
