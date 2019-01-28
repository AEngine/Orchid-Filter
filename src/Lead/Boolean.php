<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Boolean extends FilterRule
{
    /**
     * @var boolean true
     */
    public $valueTrue;

    /**
     * @var boolean false
     */
    public $valueFalse;

    /**
     * Sanitize the value to a boolean, or a pseudo-boolean
     *
     * @param mixed $true  Use this value for `true`
     * @param mixed $false Use this value for `false`
     */
    public function __construct($true, $false)
    {
        $this->replace([
            'valueTrue' => $true,
            'valueFalse' => $false,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (static::isTrue($value)) {
            $value = $this->valueTrue;

            return true;
        }

        if (static::isFalse($value)) {
            $value = $this->valueFalse;

            return true;
        }

        $value = $value ? $this->valueTrue : $this->valueFalse;

        return true;
    }
}
