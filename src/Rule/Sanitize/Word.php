<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Word
{
    /**
     * Strips non-word characters within the value (letters, numbers, and underscores)
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = preg_replace('/[^\p{L}\p{Nd}_]/u', '', $value);

            return true;
        };
    }
}
