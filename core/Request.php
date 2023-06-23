<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position_of_questionmark = strpos($path, '?');
        if(!$position_of_questionmark) {
            return $path;
        }
        $path = substr($path, 0, $position_of_questionmark);
        return $path;
    }
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isGet()
    {
        return $this->method() === 'get';
    }
    public function isPost()
    {
        return $this->method() === 'post';
    }
}
