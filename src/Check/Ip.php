<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Ip extends FilterRule
{
    /**
     * @var mixed
     */
    public $flags;

    /**
     * Validates that the value is an IP address
     *
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     *                     cf. <http://php.net/manual/en/filter.filters.flags.php>.
     */
    public function __construct($flags = null)
    {
        $this->replace([
            'flags' => $flags,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        if ($this->flags === null) {
            $this->flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
        }

        return filter_var($data[$field], FILTER_VALIDATE_IP, $this->flags) !== false;
    }
}
