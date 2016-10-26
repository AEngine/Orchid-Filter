<?php

namespace AEngine\Orchid\Filter\Validate\Rule\Sanitize;

use Closure;

trait DateTime
{
    // Russian date format (ГОСТ Р 6.30-2003 (п. 3.11))
    public static $DATE_RU = 'd.m.Y';

    // English date format
    public static $DATE_EN = 'd-m-Y';

    // US date format
    public static $DATE_US = 'm-d-Y';

    // data bases date format (ISO 8601)
    public static $DATE_DB = 'Y-m-d';

    // 12-hour format
    public static $TIME_12 = 'h:i:s';

    // 24-hour format
    public static $TIME_24 = 'H:i:s';

    // 12-hour format (without seconds)
    public static $TIME_MINUTE_12 = 'h:i';

    // 24-hour format (without seconds)
    public static $TIME_MINUTE_24 = 'H:i';

    /**
     * Sanitize a datetime to a specified format (default "Y-m-d H:i:s")
     *
     * @param string $format date format to use
     *
     * @return Closure
     */
    public function DateTime($format = 'Y-m-d H:i:s')
    {
        return function (&$field) use ($format) {
            if (($time = strtotime($field)) !== false) {
                $field = date($format, $time);

                return true;
            }

            return false;
        };
    }
}