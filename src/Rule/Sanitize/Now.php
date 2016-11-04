<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class Now
{
    /**
     * Force the value to the current time, default format "Y-m-d H:i:s".
     *
     * @param string $format date format to use
     *
     * @return Closure
     */
    public function __invoke($format = 'Y-m-d H:i:s')
    {
        return function (&$field) use ($format) {
            $field = date($format);

            return true;
        };
    }
}
