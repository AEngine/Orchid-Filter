<?php

namespace AEngine\Orchid\Filter\Rule\Sanitize;

use Closure;

class DateTime
{
    // Russian date format (ГОСТ Р 6.30-2003 (п. 3.11))
    const DATE_RU = 'd.m.Y';

    // English date format
    const DATE_EN = 'd-m-Y';

    // US date format
    const DATE_US = 'm-d-Y';

    // data bases date format (ISO 8601)
    const DATE_DB = 'Y-m-d';

    // 12-hour format
    const TIME_12 = 'h:i:s';

    // 24-hour format
    const TIME_24 = 'H:i:s';

    // 12-hour format (without seconds)
    const TIME_MINUTE_12 = 'h:i';

    // 24-hour format (without seconds)
    const TIME_MINUTE_24 = 'H:i';

    /**
     * Sanitize a datetime to a specified format (default "Y-m-d H:i:s")
     *
     * @param string $format date format to use
     *
     * @return Closure
     */
    public function __invoke($format = 'Y-m-d H:i:s')
    {
        return function (&$field) use ($format) {
            if (is_numeric($field)) {
                $field = date($format, $field);

                return true;
            }

            if (is_string($field) && ($time = strtotime($field)) !== false) {
                $field = date($format, $time);

                return true;
            }

            return false;
        };
    }
}
