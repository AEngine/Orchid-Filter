<?php

namespace AEngine\Orchid\Filter\Check;

use AEngine\Orchid\Filter\FilterAnnotation;
use AEngine\Orchid\Annotations\Annotation\Target;

/**
 * @Target('PROPERTY')
 */
class Upload extends FilterAnnotation
{
    /**
     * Validates that the value is an array of file-upload information, and
     * if a file is referred to, that is actually an uploaded file
     */
    public function __construct()
    {
    }

    public function __invoke(&$data, $field)
    {
        $default = [
            'error' => '',
            'name' => '',
            'size' => '',
            'tmp_name' => '',
            'type' => '',
        ];
        $value = array_merge($default, (array)$data[$field] ?? []);

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
    }
}
