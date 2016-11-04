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
        return function (&$field) {
            if (!is_scalar($field)) {
                return false;
            }

            $field = preg_replace('/[^\p{L}\p{Nd}_]/u', '', $field);

            return true;
        };
    }
}
