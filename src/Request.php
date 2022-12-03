<?php 

declare(strict_types=1);

namespace App;

class Request
{
    const BASE_URL = 'http://localhost/teb/';
    private $get, $post, $server = [];

    public function __construct($get, $post)
    {
        $this -> get = $get;
        $this -> post = $post;
        $this -> server = $_SERVER;
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

    public function isPost()
    {
        return $this -> server['REQUEST_METHOD'] === 'POST';
    }

    public function isGet()
    {
        return $this -> server['REQUEST_METHOD'] === 'GET';
    }
}