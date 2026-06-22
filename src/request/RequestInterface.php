<?php

namespace framework\contracts\request;

interface RequestInterface
{
    public function path();

    public function get(string $key = '', $default = null);

    public function post(string $key = '', $default = null);

    public function input(string $key = '', $default = null);

    public function method();

    public function file(string $key = '');

    public function files(string $key = '');

    public function put($key, $value);

    public function validate(array|string $rules);
}
