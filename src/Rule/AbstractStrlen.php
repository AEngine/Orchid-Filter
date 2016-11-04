<?php

namespace AEngine\Orchid\Filter\Rule;

abstract class AbstractStrlen
{
    /**
     * @param string $input
     * @param int    $pad_length
     * @param string $pad_string
     * @param int    $pad_type
     *
     * @return string
     */
    protected function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $diff = strlen($input) - mb_strlen($input);

        return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
    }
}
