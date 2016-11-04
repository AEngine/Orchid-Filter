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
        return function (&$data, $field) {
            $default = [
                'error'    => '',
                'name'     => '',
                'size'     => '',
                'tmp_name' => '',
                'type'     => '',
            ];
            $value = $data[$field] = array_merge($default, (array)$data[$field] ?? []);

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
}
