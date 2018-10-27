<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class StrReplace extends FilterRule
{
    /**
     * @var string|array
     */
    public $find;

    /**
     * @var string|array
     */
    public $replace;

    /**
     * Forces the value to a string, optionally applying `str_replace()`
     *
     * @param string|array $find    Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     */
    public function __construct($find, $replace)
    {
        $this->replace([
            'find' => $find,
            'replace' => $replace,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $value = &$data[$field];

        if (!is_scalar($value)) {
            return false;
        }
        if ($this->find || $this->replace) {
            $value = str_replace($this->find, $this->replace, $value);
        }

        return true;
    }
}
