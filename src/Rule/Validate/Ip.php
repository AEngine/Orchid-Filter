<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Ip
{
    /**
     * Validates that the value is an IP address
     *
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     *                     cf. <http://php.net/manual/en/filter.filters.flags.php>.
     *
     * @return Closure
     */
    public function __invoke($flags = null)
    {
        return function ($field) use ($flags) {
            if ($flags === null) {
                $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
            }

            return filter_var($field, FILTER_VALIDATE_IP, $flags) !== false;
        };
    }
}
