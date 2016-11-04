<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Url
{
    /**
     * Validates the value as a URL
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($field) {
            if (!is_scalar($field)) {
                return false;
            }

            // first, make sure there are no invalid chars, list from ext/filter
            $other = "$-_.+"        // safe
                . "!*'(),"       // extra
                . "{}|\\^~[]`"   // national
                . "<>#%\""       // punctuation
                . ";/?:@&=";     // reserved
            $valid = 'a-zA-Z0-9' . preg_quote($other, '/');
            $clean = preg_replace("/[^$valid]/", '', $field);
            if ($field != $clean) {
                return false;
            }

            $result = @parse_url($field);
            if (empty($result['scheme']) || trim($result['scheme']) == '' ||
                empty($result['host']) || trim($result['host']) == ''
            ) {
                return false;
            }

            return true;
        };
    }
}
