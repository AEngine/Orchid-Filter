<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Url extends FilterRule
{
    /**
     * Validates the value as a URL
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $value = $data[$field];

        if (!is_scalar($value)) {
            return false;
        }

        // first, make sure there are no invalid chars, list from ext/filter
        $other = "$-_.+"        // safe
            . "!*'(),"       // extra
            . "{}|\\^~[]`"   // national
            . "<>#%\""       // punctuation
            . ";/?:@&=";     // reserved

        $valid = 'a-zA-Z0-9' . preg_quote($other, '/');
        $clean = preg_replace("/[^$valid]/", '', $value);
        if ($value != $clean) {
            return false;
        }

        $result = @parse_url($value);
        if (
            empty($result['scheme']) || trim($result['scheme']) == '' ||
            empty($result['host']) || trim($result['host']) == ''
        ) {
            return false;
        }

        return true;
    }
}
