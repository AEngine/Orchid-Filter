<?php

namespace AEngine\Orchid\Filter\Rule\Validate;

use Closure;

class Upload
{
    /**
     * Validates that the value is an array of file-upload information, and
     * if a file is referred to, that is actually an uploaded file
     *
     * @return Closure
     */
    public function __invoke()
    {
        return function ($data, $field) {
            $expect = [
                'error',
                'name',
                'size',
                'tmp_name',
                'type',
            ];
            $value = array_merge($expect, $data[$field]);
        };
    }
}
