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
        return function ($field) {
            $expect = [
                'error',
                'name',
                'size',
                'tmp_name',
                'type',
            ];
            $field = array_merge($expect, $field);
        };
    }
}
