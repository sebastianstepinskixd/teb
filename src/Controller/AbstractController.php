<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database;
use App\Exception\NotFoundException;
use App\Request;
use App\View;

class AbstractController
{   
    const DEFAULT_ACTION = 'list';
    protected static $configuration = [];
    protected $database;
    protected $request;
    protected $view;

    public function __construct(Request $request)
    {
        $this -> request = $request;
        $this -> database = new Database(self::$configuration);
        $this -> action = $this -> action();
        $this -> view = new View();
    }

    public static function initConfiguration($configuration)
    {
        self::$configuration = $configuration;
    }

    public function run()
    {
        $action = $this -> action . 'Action';
        if(!method_exists($this, $action))
            $action = self::DEFAULT_ACTION . "Action";

        $this -> $action();
    }

    protected function action()
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }

    protected function redirect($location, $params)
    {
        $location = Request::BASE_URL . $location;
        if(count($params))
        {
            $queryParams = [];
            foreach($params as $key => $value)
                $queryParams[] = urlencode($key) . '=' . urlencode($value);

            $queryParams = implode('&', $queryParams);
            $location .= "?" . $queryParams;
        }

        header("Location: $location");
        exit;
    }
}

?>