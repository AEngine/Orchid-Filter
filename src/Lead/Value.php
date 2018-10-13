<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Value extends FilterRule
{
    /**
     * @var mixed
     */
    public $otherValue;

    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     */
    public function __construct($otherValue)
    {
        $this->replace([
            'otherValue' => $otherValue,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $data[$field] = $this->otherValue;

        return true;
    }
}
