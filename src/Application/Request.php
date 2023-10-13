<?php

namespace Src\Application;

class Request
{
    private $body;

    public function __construct() {
        $this->body = (object)$_REQUEST;
    }

    public function get(string $key, mixed $default = null)
    {
        return isset($this->body->{$key}) ? htmlspecialchars(filter_var($this->body->{$key})) : $default;
    }

    public function set(string $key, mixed $value)
    {
        $this->body->{$key} = $value;
    }
}
