<?php

namespace AEngine\Orchid\Filter;

use Closure;

trait TraitHelper
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
     * If the value is less than min, will set the min value,
     * and if value is greater than max, set the max value
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function leadBetween($min, $max)
    {
        return function (&$data, $field) use ($min, $max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value < $min) {
                $value = $min;
            }
            if ($value > $max) {
                $value = $max;
            }

            return true;
        };
    }

    /**
     * Sanitize the value to a boolean, or a pseudo-boolean
     *
     * @param mixed $true Use this value for `true`
     * @param mixed $false Use this value for `false`
     *
     * @return Closure
     */
    public function leadBoolean($true = true, $false = false)
    {
        return function (&$data, $field) use ($true, $false) {
            $value = &$data[$field];
            if ($this->isTrue($value)) {
                $value = $true;

                return true;
            }

            if ($this->isFalse($value)) {
                $value = $false;

                return true;
            }

            $value = $value ? $true : $false;

            return true;
        };
    }

    /**
     * Sanitizes a value using a callable
     *
     * @return Closure
     */
    public function leadCallback()
    {
        return function (&$data, $field) {
            return $data[$field]($data, $field);
        };
    }

    /**
     * Sanitize a datetime to a specified format (default "Y-m-d H:i:s")
     *
     * @param string $format date format to use
     *
     * @return Closure
     */
    public function leadDateTime($format = 'Y-m-d H:i:s')
    {
        return function (&$data, $field) use ($format) {
            $value = &$data[$field];
            if (is_numeric($value)) {
                $value = date($format, $value);

                return true;
            }

            if (is_string($value) && ($time = strtotime($value)) !== false) {
                $value = date($format, $time);

                return true;
            }

            return false;
        };
    }

    /**
     * Forces the value to a float
     *
     * @param int $precision rounding precision
     *
     * @return Closure
     */
    public function leadDouble($precision = 0)
    {
        return function (&$data, $field) use ($precision) {
            $value = &$data[$field];
            if (is_numeric($value) || is_string($value)) {
                $value = round((double)$value, $precision);

                return true;
            }

            return false;
        };
    }

    /**
     * Sanitizes escapes a string
     *
     * @return Closure
     */
    public function leadEscape()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (is_string($value)) {
                $value = str_replace(
                    ['\'', '"', '>', '<', '`', '\\'],
                    ['&#039;', '&#34;', '&#62;', '&#60;', '&#96;', '&#92;'],
                    $value
                );
            }

            return true;
        };
    }

    /**
     * Forces the value to an integer
     *
     * @return Closure
     */
    public function leadInteger()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (is_numeric($value) || is_string($value)) {
                $value = (float)$value;
                $value = (int)$value;

                return true;
            }

            return false;
        };
    }

    /**
     * Sanitizes a string to lowercase
     *
     * @return Closure
     */
    public function leadLowercase()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = strtolower($value);

            return true;
        };
    }

    /**
     * Sanitizes to maximum value if value is greater than max
     *
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function leadMax($max)
    {
        return function (&$data, $field) use ($max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value > $max) {
                $value = $max;
            }

            return true;
        };
    }

    /**
     * Sanitizes to minimum value if value is less than min
     *
     * @param int $min minimum valid value
     *
     * @return Closure
     */
    public function leadMin($min)
    {
        return function (&$data, $field) use ($min) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($value < $min) {
                $value = $min;
            }

            return true;
        };
    }

    /**
     * Force the value to the current time, default format "Y-m-d H:i:s".
     *
     * @param string $format date format to use
     *
     * @return Closure
     */
    public function leadNow($format = 'Y-m-d H:i:s')
    {
        return function (&$data, $field) use ($format) {
            $data[$field] = date($format);

            return true;
        };
    }

    /**
     * Applies `preg_replace()` to the value
     *
     * @param string $expr regular expression pattern to apply
     * @param string $replace Replace the found pattern with this string
     *
     * @return Closure
     */
    public function leadRegex($expr, $replace)
    {
        return function (&$data, $field) use ($expr, $replace) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = preg_replace($expr, $replace, $value);

            return true;
        };
    }

    /**
     * Removes the field from the data with unset()
     *
     * @return Closure
     */
    public function leadRemove()
    {
        return function (&$data, $field) {
            unset($data[$field]);

            return true;
        };
    }

    /**
     * Forces the value to a string
     *
     * @return Closure
     */
    public function leadStr()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value) || !method_exists($value, '__toString')) {
                return false;
            }

            $value = strval($value);

            return false;
        };
    }

    /**
     * Sanitizes a string to an exact length by padding or chopping it
     *
     * @param int $len minimum string length
     * @param string $padString Pad using this string
     * @param int $padType A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function leadStrlen($len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$data, $field) use ($len, $padString, $padType) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $strlen = mb_strlen($value);

            if ($strlen < $len) {
                $value = $this->mbStrPad($value, $len, $padString, $padType);
            }
            if ($strlen > $len) {
                $value = mb_substr($value, 0, $len);
            }

            return true;
        };
    }

    /**
     * Sanitizes a string to a length range by padding or chopping it
     *
     * @param int $min minimum length
     * @param int $max maximum length
     * @param string $padString Pad using this string
     * @param int $padType A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function leadStrlenBetween($min, $max, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$data, $field) use ($min, $max, $padString, $padType) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if (mb_strlen($value) < $min) {
                $value = $this->mbStrPad($value, $min, $padString, $padType);;
            }
            if (mb_strlen($value) > $max) {
                $value = mb_substr($value, 0, $max);
            }

            return true;
        };
    }

    /**
     * Sanitizes a string to a maximum length by chopping it at the right
     *
     * @param int $max maximum length.
     *
     * @return Closure
     */
    public function leadStrlenMax($max)
    {
        return function (&$data, $field) use ($max) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if (mb_strlen($value) > $max) {
                $value = mb_substr($value, 0, $max);
            }

            return true;
        };
    }

    /**
     * Sanitizes a string to a minimum length by padding it
     *
     * @param int $min minimum length
     * @param string $padString Pad using this string
     * @param int $padType A `STR_PAD_*` constant
     *
     * @return Closure
     */
    public function leadStrlenMin($min, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return function (&$data, $field) use ($min, $padString, $padType) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if (mb_strlen($value) < $min) {
                $value = $this->mbStrPad($value, $min, $padString, $padType);;
            }

            return true;
        };
    }

    /**
     * Forces the value to a string, optionally applying `str_replace()`
     *
     * @param string|array $find Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     *
     * @return Closure
     */
    public function leadStrReplace($find = null, $replace = null)
    {
        return function (&$data, $field) use ($find, $replace) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            if ($find || $replace) {
                $value = str_replace($find, $replace, $value);
            }

            return true;
        };
    }

    /**
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     *
     * @return Closure
     */
    public function leadTrim($chars = " \t\n\r\0\x0B")
    {
        return function (&$data, $field) use ($chars) {
            $value = &$data[$field];
            if (is_scalar($value) || $value === null) {
                $value = trim($value, $chars);

                return true;
            }

            return false;
        };
    }

    /**
     * Sanitizes a string to uppercase
     *
     * @return Closure
     */
    public function leadUppercase()
    {
        return function (&$data, $field) {
            $value = &$data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            $value = strtoupper($value);

            return true;
        };
    }

    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     *
     * @return Closure
     */
    public function leadValue($otherValue)
    {
        return function (&$data, $field) use ($otherValue) {
            $data[$field] = $otherValue;

            return true;
        };
    }

    /**
     * Strips non-word characters within the value (letters, numbers, and underscores)
     *
     * @return Closure
     */
    public function leadWord()
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

    /**
     * Validates that the value is within a given range
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     *
     * @return Closure
     */
    public function checkBetween($min, $max)
    {
        return function ($data, $field) use ($min, $max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return ($value >= $min && $value <= $max);
        };
    }

    /**
     * Validates that the value is a boolean representation
     *
     * @return Closure
     */
    public function checkBoolean()
    {
        return function ($data, $field) {
            return $this->isTrue($data[$field]) || $this->isFalse($data[$field]);
        };
    }

    /**
     * Validates the value as a credit card number
     *
     * @return Closure
     */
    public function checkCreditCard()
    {
        return function ($data, $field) {
            $value = $data[$field];
            // get the value; remove spaces, dashes, and dots
            $value = str_replace([' ', '-', '.'], '', (string)$value);

            // is it composed only of digits?
            if (!ctype_digit($value)) {
                return false;
            }

            // luhn mod-10 algorithm: https://gist.github.com/1287893
            $sumTable = [
                [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                [0, 2, 4, 6, 8, 1, 3, 5, 7, 9],
            ];

            $sum  = 0;
            $flip = 0;

            for ($i = strlen($value) - 1; $i >= 0; $i--) {
                $sum += $sumTable[$flip++ & 0x1][$value[$i]];
            }

            return $sum % 10 === 0;
        };
    }

    /**
     * Validates that the value represents a float
     *
     * @return Closure
     */
    public function checkDouble()
    {
        return function ($data, $field) {
            $value = $data[$field];
            if (is_float($value)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to float
            return is_numeric($value) && $value == (float)$value;
        };
    }

    /**
     * Validates that the value is an email address
     *
     * @return Closure
     */
    public function checkEmail()
    {
        return function ($data, $field) {
            return !!filter_var($data[$field], FILTER_VALIDATE_EMAIL);
        };
    }

    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $other_field Check against the value of this subject field
     *
     * @return Closure
     */
    public function checkEqualToField($other_field)
    {
        return function ($data, $field) use ($other_field) {
            // the other field needs to exist and *not* be null
            if (!isset($data[$other_field])) {
                return false;
            }

            return $data[$field] == $data[$other_field];
        };
    }

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $other_value other value
     *
     * @return Closure
     */
    public function checkEqualToValue($other_value)
    {
        return function ($data, $field) use ($other_value) {
            return $data[$field] == $other_value;
        };
    }

    /**
     * Validates that the value is a key in a given array
     *
     * @param array $array array of key-value pairs; the value must match
     *                     one of the keys in this array
     *
     * @return Closure
     */
    public function checkInKeys(array $array)
    {
        return function ($data, $field) use ($array) {
            $value = $data[$field];
            if (!is_string($value) && !is_int($value)) {
                // array_key_exists errors on non-string non-int keys.
                return false;
            }

            // using array_keys() converts string numeric keys to integers, which
            // is *not* the behavior we want.
            return array_key_exists($value, $array);
        };
    }

    /**
     * Validates that the value represents an integer
     *
     * @return Closure
     */
    public function checkInteger()
    {
        return function ($data, $field) {
            $value = $data[$field];
            if (is_int($value)) {
                return true;
            }

            // otherwise, must be numeric, and must be same as when cast to int
            return is_numeric($value) && $value == (int)$value;
        };
    }

    /**
     * Validates that the value is in a given array
     *
     * @param array $array array of allowed values
     *
     * @return Closure
     */
    public function checkInValues(array $array)
    {
        return function ($data, $field) use ($array) {
            return in_array($data[$field], $array, true);
        };
    }

    /**
     * Validates that the value is an IP address
     *
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     *                     cf. <http://php.net/manual/en/filter.filters.flags.php>.
     *
     * @return Closure
     */
    public function checkIp($flags = null)
    {
        return function ($data, $field) use ($flags) {
            if ($flags === null) {
                $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
            }

            return filter_var($data[$field], FILTER_VALIDATE_IP, $flags) !== false;
        };
    }

    /**
     * Validates that the value is less than than or equal to a maximum
     *
     * @param string $max maximum valid value
     *
     * @return Closure
     */
    public function checkMax($max)
    {
        return function ($data, $field) use ($max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return $value <= $max;
        };
    }

    /**
     * Validates that the value is greater than or equal to a minimum
     *
     * @param string $min minimum valid value
     *
     * @return Closure
     */
    public function checkMin($min)
    {
        return function ($data, $field) use ($min) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return $value >= $min;
        };
    }

    /**
     * Validates that the value is phone
     *
     * @return Closure
     */
    public function checkPhone()
    {
        $pattern = '\(?\+[0-9]{1,3}\)? ?-?[0-9]{1,3} ?-?[0-9]{3,5} ?-?[0-9]{4}( ?-?[0-9]{3})? ?(\w{1,10}\s?\d{1,6})?';

        return function ($data, $field) use ($pattern) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            if (preg_match($pattern, $value)) {
                return true;
            }

            return false;
        };
    }

    /**
     * Validates the value against a regular expression
     *
     * @param string $expr regular expression pattern to apply
     *
     * @return Closure
     */
    public function checkRegex($expr)
    {
        return function ($data, $field) use ($expr) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return (bool)preg_match($expr, $value);
        };
    }

    /**
     * Validates that the value represents a string
     *
     * @return Closure
     */
    public function checkStr()
    {
        return function ($data, $field) {
            return is_string($data[$field]);
        };
    }

    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $other_field Check against the value of this subject field
     *
     * @return Closure
     */
    public function checkStrictEqualToField($other_field)
    {
        return function ($data, $field) use ($other_field) {
            // the other field needs to exist and *not* be null
            if (!isset($data[$other_field])) {
                return false;
            }

            return $data[$field] === $data[$other_field];
        };
    }

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $other_value other value
     *
     * @return Closure
     */
    public function checkStrictEqualToValue($other_value)
    {
        return function ($data, $field) use ($other_value) {
            return $data[$field] === $other_value;
        };
    }

    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $len valid length
     *
     * @return Closure
     */
    public function checkStrlen($len)
    {
        return function ($data, $field) use ($len) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return mb_strlen($value) == $len;
        };
    }

    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $min minimum valid length.
     * @param int $max maximum valid length.
     *
     * @return Closure
     */
    public function checkStrlenBetween($min, $max)
    {
        return function ($data, $field) use ($min, $max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }
            $len = mb_strlen($value);

            return ($len >= $min && $len <= $max);
        };
    }

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $max value must have no more than this many
     *
     * @return Closure
     */
    public function checkStrlenMax($max)
    {
        return function ($data, $field) use ($max) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return mb_strlen($value) <= $max;
        };
    }

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $min value must have at least this many characters
     *
     * @return Closure
     */
    public function checkStrlenMin($min)
    {
        return function ($data, $field) use ($min) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return mb_strlen($value) >= $min;
        };
    }

    /**
     * Validates that a value is already trimmed
     *
     * @param string $chars characters to strip
     *
     * @return Closure
     */
    public function checkTrim($chars = " \t\n\r\0\x0B")
    {
        return function ($data, $field) use ($chars) {
            $value = $data[$field];
            if (!is_scalar($value)) {
                return false;
            }

            return trim($value, $chars) == $value;
        };
    }

    /**
     * Validates that the value is an array of file-upload information, and
     * if a file is referred to, that is actually an uploaded file
     *
     * @return Closure
     */
    public function checkUpload()
    {
        return function (&$data, $field) {
            $default = [
                'error'    => '',
                'name'     => '',
                'size'     => '',
                'tmp_name' => '',
                'type'     => '',
            ];
            $value   = $data[$field] = array_merge($default, (array)$data[$field] ?? []);

            // remove unexpected keys
            $expect = array_keys($default);
            foreach ($value as $key => $val) {
                if (!in_array($key, $expect)) {
                    unset($value[$key]);
                }
            }

            // was the upload explicitly ok?
            if ($value['error'] != UPLOAD_ERR_OK) {
                return false;
            }

            // is it actually an uploaded file?
            if (is_uploaded_file($value['tmp_name'])) {
                return true;
            }

            return false;
        };
    }

    /**
     * Validates the value as a URL
     *
     * @return Closure
     */
    public function checkUrl()
    {
        return function ($data, $field) {
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
            if (empty($result['scheme']) || trim($result['scheme']) == '' ||
                empty($result['host']) || trim($result['host']) == ''
            ) {
                return false;
            }

            return true;
        };
    }

    /**
     * Validates that the value is Empty
     *
     * @return Closure
     */
    public function checkValueEmpty()
    {
        return function ($data, $field) {
            return empty($data[$field]);
        };
    }

    /**
     * Validates that the value is *not* Empty
     *
     * @return Closure
     */
    public function checkValueNotEmpty()
    {
        return function ($data, $field) {
            return !empty($data[$field]);
        };
    }

    /**
     * Pseudo-true representations.
     *
     * @var array
     */
    protected $true = ['1', 'on', 'true', 't', 'yes', 'y'];

    /**
     * Pseudo-false representations; `null` and empty-string are *not* included.
     *
     * @var array
     */
    protected $false = ['0', 'off', 'false', 'f', 'no', 'n'];

    /**
     * @param $value
     * @return bool
     */
    protected function isTrue($value)
    {
        if (!$this->isBoolish($value)) {
            return false;
        }

        return $value === true || in_array(strtolower(trim($value)), $this->true);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isFalse($value)
    {
        if (!$this->isBoolish($value)) {
            return false;
        }

        return $value === false || in_array(strtolower(trim($value)), $this->false);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isBoolish($value)
    {
        if (is_string($value) || is_int($value) || is_bool($value)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $input
     * @param int $pad_length
     * @param string $pad_string
     * @param int $pad_type
     *
     * @return string
     */
    protected function mbStrPad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $diff = strlen($input) - mb_strlen($input);

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }
}
