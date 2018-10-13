<?php

namespace AEngine\Orchid\Filter\Lead;

use AEngine\Orchid\Filter\FilterRule;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Now extends FilterRule
{
    /**
     * @var string
     */
    public $format;

    /**
     * Force the value to the current time (default format "Y-m-d H:i:s")
     *
     * @param string $format date format to use
     */
    public function __construct($format = 'Y-m-d H:i:s')
    {
        $this->replace([
            'format' => $format,
        ]);
    }

    public function __invoke(&$data, $field)
    {
        $data[$field] = date($this->format);

        return true;
    }
}
