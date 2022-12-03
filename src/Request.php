<?php 

declare(strict_types=1);

namespace App;

class Request
{
    const BASE_URL = 'http://localhost/teb/';
    private $get, $post = [];

    public function __construct($get, $post)
    {
        $this -> get = $get;
        $this -> post = $post;
    }

    public function hasPost()
    {
        return !empty($this->post);
    }
    public function getParam($name, $default = null)
    {
        return $this -> get[$name] ?? $default;
    }
    public function postParam($name, $default = null)
    {
        return $this -> post[$name] ?? $default;
    }
}