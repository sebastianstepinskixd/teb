<?php

declare(strict_types=1);

namespace App;

use App\Exception\NotFoundException;
use App\Request;

include_once('./src/view.php');
require_once('./config/config.php');
require_once('./src/Database.php');

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
}

?>