<?php

namespace framework\contracts\request;

interface ResponseInterface
{
    public function send($content);

    public function json($data);

    public function redirect($url);

    public function view($template, $data = []);

    public function file($path);
}
