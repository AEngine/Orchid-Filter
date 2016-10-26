<?php

namespace AEngine\Filter\Validate;

use Closure;

trait Str
{
    /**
     * Checked value is the E-Mail address
     *
     * @return Closure
     */
    public function isEmail()
    {
        return function ($field) {
            return !!filter_var($field, FILTER_VALIDATE_EMAIL);
        };
    }

    /**
     * Checked value is the IP address
     *
     * @return Closure
     */
    public function isIp()
    {
        return function ($field) {
            return !!filter_var($field, FILTER_VALIDATE_IP);
        };
    }
}
