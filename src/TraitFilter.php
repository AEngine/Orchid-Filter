<?php

namespace AEngine\Orchid\Filter;

trait TraitFilter
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
     * @return Lead\Between
     */
    public function leadBetween($min, $max)
    {
        return new Lead\Between($min, $max);
    }

    /**
     * Sanitize the value to a boolean, or a pseudo-boolean
     *
     * @param mixed $true  Use this value for `true`
     * @param mixed $false Use this value for `false`
     *
     * @return Lead\Boolean
     */
    public function leadBoolean($true = true, $false = false)
    {
        return new Lead\Boolean($true, $false);
    }

    /**
     * Sanitizes a value using a callable
     *
     * @return Lead\Callback
     */
    public function leadCallback()
    {
        return new Lead\Callback();
    }

    /**
     * Sanitize a datetime to a specified format (default "Y-m-d H:i:s")
     *
     * @param string $format date format to use
     *
     * @return Lead\DateTime
     */
    public function leadDateTime($format = 'Y-m-d H:i:s')
    {
        return new Lead\DateTime($format);
    }

    /**
     * Forces the value to a float
     *
     * @param int $precision rounding precision
     *
     * @return Lead\Double
     */
    public function leadDouble($precision = 0)
    {
        return new Lead\Double($precision);
    }

    /**
     * Sanitizes escapes a string
     *
     * @return Lead\Escape
     */
    public function leadEscape()
    {
        return new Lead\Escape();
    }

    /**
     * Forces the value to an integer
     *
     * @return Lead\Integer
     */
    public function leadInteger()
    {
        return new Lead\Integer();
    }

    /**
     * Sanitizes a string to lowercase
     *
     * @return Lead\Lowercase
     */
    public function leadLowercase()
    {
        return new Lead\Lowercase();
    }

    /**
     * Sanitizes to maximum value if value is greater than max
     *
     * @param int $max maximum valid value
     *
     * @return Lead\Max
     */
    public function leadMax($max)
    {
        return new Lead\Max($max);
    }

    /**
     * Sanitizes to minimum value if value is less than min
     *
     * @param int $min minimum valid value
     *
     * @return Lead\Min
     */
    public function leadMin($min)
    {
        return new Lead\Min($min);
    }

    /**
     * Force the value to the current time, default format "Y-m-d H:i:s".
     *
     * @param string $format date format to use
     *
     * @return Lead\Now
     */
    public function leadNow($format = 'Y-m-d H:i:s')
    {
        return new Lead\Now($format);
    }

    /**
     * Applies `preg_replace()` to the value
     *
     * @param string $expr    regular expression pattern to apply
     * @param string $replace Replace the found pattern with this string
     *
     * @return Lead\Regex
     */
    public function leadRegex($expr, $replace)
    {
        return new Lead\Regex($expr, $replace);
    }

    /**
     * Removes the field from the data with unset()
     *
     * @return Lead\Remove
     */
    public function leadRemove()
    {
        return new Lead\Remove();
    }

    /**
     * Forces the value to a string
     *
     * @return Lead\Str
     */
    public function leadStr()
    {
        return new Lead\Str();
    }

    /**
     * Sanitizes a string to an exact length by padding or chopping it
     *
     * @param int    $len       minimum string length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Lead\Strlen
     */
    public function leadStrlen($len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return new Lead\Strlen($len, $padString, $padType);
    }

    /**
     * Sanitizes a string to a length range by padding or chopping it
     *
     * @param int    $min       minimum length
     * @param int    $max       maximum length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Lead\StrlenBetween
     */
    public function leadStrlenBetween($min, $max, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return new Lead\StrlenBetween($min, $max, $padString, $padType);
    }

    /**
     * Sanitizes a string to a maximum length by chopping it at the right
     *
     * @param int $max maximum length.
     *
     * @return Lead\StrlenMax
     */
    public function leadStrlenMax($max)
    {
        return new Lead\StrlenMax($max);
    }

    /**
     * Sanitizes a string to a minimum length by padding it
     *
     * @param int    $min       minimum length
     * @param string $padString Pad using this string
     * @param int    $padType   A `STR_PAD_*` constant
     *
     * @return Lead\StrlenMin
     */
    public function leadStrlenMin($min, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        return new Lead\StrlenMin($min, $padString, $padType);
    }

    /**
     * Forces the value to a string, optionally applying `str_replace()`
     *
     * @param string|array $find    Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     *
     * @return Lead\StrReplace
     */
    public function leadStrReplace($find = null, $replace = null)
    {
        return new Lead\StrReplace($find, $replace);
    }

    /**
     * Sanitizes a value to a string using trim()
     *
     * @param string $chars characters to trim
     *
     * @return Lead\Trim
     */
    public function leadTrim($chars = " \t\n\r\0\x0B")
    {
        return new Lead\Trim($chars);
    }

    /**
     * Sanitizes a string to uppercase
     *
     * @return Lead\Uppercase
     */
    public function leadUppercase()
    {
        return new Lead\Uppercase();
    }

    /**
     * Modifies the field value to match another value
     *
     * @param mixed $otherValue value to set
     *
     * @return Lead\Value
     */
    public function leadValue($otherValue)
    {
        return new Lead\Value($otherValue);
    }

    /**
     * Strips non-word characters within the value (letters, numbers, and underscores)
     *
     * @return Lead\Word
     */
    public function leadWord()
    {
        return new Lead\Word();
    }

    /**
     * Validates that the value is within a given range
     *
     * @param int $min minimum valid value
     * @param int $max maximum valid value
     *
     * @return Check\Between
     */
    public function checkBetween($min, $max)
    {
        return new Check\Between($min, $max);
    }

    /**
     * Validates that the value is a boolean representation
     *
     * @return Check\Boolean
     */
    public function checkBoolean()
    {
        return new Check\Boolean();
    }

    /**
     * Validates the value as a credit card number
     *
     * @return Check\CreditCard
     */
    public function checkCreditCard()
    {
        return new Check\CreditCard();
    }

    /**
     * Validates that the value represents a float
     *
     * @return Check\Double
     */
    public function checkDouble()
    {
        return new Check\Double();
    }

    /**
     * Validates that the value is an email address
     *
     * @return Check\Email
     */
    public function checkEmail()
    {
        return new Check\Email();
    }

    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $other_field Check against the value of this subject field
     *
     * @return Check\EqualToField
     */
    public function checkEqualToField($other_field)
    {
        return new Check\EqualToField($other_field);
    }

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $other_value other value
     *
     * @return Check\EqualToValue
     */
    public function checkEqualToValue($other_value)
    {
        return new Check\EqualToValue($other_value);
    }

    /**
     * Validates that the value is a key in a given array
     *
     * @param array $array array of key-value pairs; the value must match
     *                     one of the keys in this array
     *
     * @return Check\InKeys
     */
    public function checkInKeys(array $array)
    {
        return new Check\InKeys($array);
    }

    /**
     * Validates that the value represents an integer
     *
     * @return Check\Integer
     */
    public function checkInteger()
    {
        return new Check\Integer();
    }

    /**
     * Validates that the value is in a given array
     *
     * @param array $array array of allowed values
     *
     * @return Check\InValues
     */
    public function checkInValues(array $array)
    {
        return new Check\InValues($array);
    }

    /**
     * Validates that the value is an IP address
     *
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     *                     cf. <http://php.net/manual/en/filter.filters.flags.php>.
     *
     * @return Check\Ip
     */
    public function checkIp($flags = null)
    {
        return new Check\Ip($flags);
    }

    /**
     * Validates that the value is less than than or equal to a maximum
     *
     * @param int $max maximum valid value
     *
     * @return Check\Max
     */
    public function checkMax($max)
    {
        return new Check\Max($max);
    }

    /**
     * Validates that the value is greater than or equal to a minimum
     *
     * @param int $min minimum valid value
     *
     * @return Check\Min
     */
    public function checkMin($min)
    {
        return new Check\Min($min);
    }

    /**
     * Validates that the value is phone
     *
     * @return Check\Phone
     */
    public function checkPhone()
    {
        return new Check\Phone();
    }

    /**
     * Validates the value against a regular expression
     *
     * @param string $expr regular expression pattern to apply
     *
     * @return Check\Regex
     */
    public function checkRegex($expr)
    {
        return new Check\Regex($expr);
    }

    /**
     * Validates that the value represents a string
     *
     * @return Check\Str
     */
    public function checkStr()
    {
        return new Check\Str();
    }

    /**
     * Validates that this value is loosely equal to some other subject field
     *
     * @param string $other_field Check against the value of this subject field
     *
     * @return Check\StrictEqualToField
     */
    public function checkStrictEqualToField($other_field)
    {
        return new Check\StrictEqualToField($other_field);
    }

    /**
     * Validates that this value is loosely equal to another value
     *
     * @param string $other_value other value
     *
     * @return Check\StrictEqualToValue
     */
    public function checkStrictEqualToValue($other_value)
    {
        return new Check\StrictEqualToValue($other_value);
    }

    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $len valid length
     *
     * @return Check\Strlen
     */
    public function checkStrlen($len)
    {
        return new Check\Strlen($len);
    }

    /**
     * Validates that the length of the value is within a given range
     *
     * @param int $min minimum valid length.
     * @param int $max maximum valid length.
     *
     * @return Check\StrlenBetween
     */
    public function checkStrlenBetween($min, $max)
    {
        return new Check\StrlenBetween($min, $max);
    }

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $max value must have no more than this many
     *
     * @return Check\StrlenMax
     */
    public function checkStrlenMax($max)
    {
        return new Check\StrlenMax($max);
    }

    /**
     * Validates that a value is no longer than a certain length
     *
     * @param int $min value must have at least this many characters
     *
     * @return Check\StrlenMin
     */
    public function checkStrlenMin($min)
    {
        return new Check\StrlenMin($min);
    }

    /**
     * Validates that a value is already trimmed
     *
     * @param string $chars characters to strip
     *
     * @return Check\Trim
     */
    public function checkTrim($chars = " \t\n\r\0\x0B")
    {
        return new Check\Trim($chars);
    }

    /**
     * Validates that the value is an array of file-upload information, and
     * if a file is referred to, that is actually an uploaded file
     *
     * @return Check\Upload
     */
    public function checkUpload()
    {
        return new Check\Upload();
    }

    /**
     * Validates the value as a URL
     *
     * @return Check\Url
     */
    public function checkUrl()
    {
        return new Check\Url();
    }

    /**
     * Validates that the value is Empty
     *
     * @return Check\ValueEmpty
     */
    public function checkValueEmpty()
    {
        return new Check\ValueEmpty();
    }

    /**
     * Validates that the value is *not* Empty
     *
     * @return Check\ValueNotEmpty
     */
    public function checkValueNotEmpty()
    {
        return new Check\ValueNotEmpty();
    }
}
