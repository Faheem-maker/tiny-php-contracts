<?php

namespace framework\contracts;

abstract class Validator
{
    protected $message = '';

    public function __construct($message = '')
    {
        if (!empty($message)) {
            $this->message = $message;
        }
    }

    public function message()
    {
        $msg = $this->message;
        foreach (get_object_vars($this) as $key => $value) {
            if (is_scalar($value)) {
                $msg = str_replace("{" . $key . "}", $value, $msg);
            }
        }
        return $msg;
    }

    public abstract function validate($value, $doc = null): bool;

}