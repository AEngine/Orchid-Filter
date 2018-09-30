<?php

namespace AEngine\Orchid\Filter;

use Closure;
use RuntimeException;

class Filter
{
    protected $data       = [];
    protected $field      = null;
    protected $rule       = [];
    protected $globalRule = [];
    protected $globalList = [];
    protected $error      = [];

    /**
     * Validator constructor
     *
     * @param array $data
     */
    public function __construct(array &$data)
    {
        $this->data = &$data;
    }

    /**
     * Select required field validation
     *
     * @param string $field
     *
     * @return self
     */
    public function attr($field)
    {
        $this->globalList[] = $this->field = $field;

        return $this;
    }

    /**
     * Select not required (optional) field validation
     *
     * @param string $field
     *
     * @return self
     */
    public function option($field)
    {
        $this->field = null;

        if (!empty($this->data[$field])) {
            $this->globalList[] = $this->field = $field;
        }

        return $this;
    }

    /**
     * Adds to selected field rule
     *
     * @param Closure $rule
     * @param string  $message when error return this text
     *
     * @return self
     * @throws RuntimeException
     */
    public function addRule($rule, $message = '')
    {
        if ($this->field) {
            $this->rule[$this->field][] = [
                'rule'    => $rule,
                'message' => $message,
            ];
        }

        return $this;
    }

    /**
     * Adds global rule
     *
     * @param Closure $rule
     * @param string  $message
     *
     * @return $this
     */
    public function addGlobalRule($rule, $message = '')
    {
        $this->globalRule[] = [
            'rule'    => $rule,
            'message' => $message,
        ];

        return $this;
    }

    /**
     * Performs rules
     *
     * @return array|bool
     */
    public function run()
    {
        $this->error = [];

        // check rule by fields
        foreach ($this->rule as $field => $rules) {
            foreach ($rules as $rule) {
                if ($rule['rule']($this->data, $field) !== true) {
                    $this->error[$field] = $rule['message'] ? $rule['message'] : false;
                    break;
                }
            }
        }

        // check global by selected fields in globalList
        if ($this->globalRule) {
            foreach (array_unique($this->globalList) as $field) {
                foreach ($this->globalRule as $rule) {
                    if ($rule['rule']($this->data, $field) !== true) {
                        $this->error[$field] = $rule['message'] ? $rule['message'] : false;
                        break;
                    }
                }
            }
        }

        return $this->error ? $this->error : true;
    }
}
