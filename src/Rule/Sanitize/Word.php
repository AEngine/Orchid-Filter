<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait Word
{
    /**
     * Strips non-word characters within the value (letters, numbers, and underscores)
     *
     * @return Closure
     */
    public function Word()
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
