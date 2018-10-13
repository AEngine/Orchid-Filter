<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Trim extends FilterRule
{
    /**
     * @var string
     */
    public $chars;

    /**
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     */
    public function __construct($chars = " \t\n\r\0\x0B")
    {
        $this->replace([
            'chars' => $chars,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (is_scalar($value) || $value === null) {
            $value = trim($value, $this->chars);

            return true;
        }

        return false;
    }
}
