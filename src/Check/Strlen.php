<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Strlen extends FilterRule
{
    /**
     * @var integer
     */
    public $len;

    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $len valid length
     */
    public function __construct($len)
    {
        $this->replace([
            'len' => $len,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        return mb_strlen($value) == $this->len;
    }
}
