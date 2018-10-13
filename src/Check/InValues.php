<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class InValues extends FilterRule
{
    /**
     * @var array
     */
    public $array;

    /**
     * Validates that the value is in a given array
     *
     * @param array $array array of allowed values
     */
    public function __construct($array)
    {
        $this->replace([
            'array' => $array,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        return in_array($data[$field], $this->array, true);
    }
}
