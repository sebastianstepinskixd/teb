<?php

declare(strict_types=1);

namespace App;

require_once('./src/view.php');

class Controller
{   
    const DEFAULT_ACTION = 'list';
    private static $configuration = [];
    private $database;

    public function __constuctor()
    {
        $this -> postData = $_POST;
        $this -> getData = $_GET;
        $this -> database = new Database(self::$configuration);
    }

    public static function initConfiguration($configuration)
    {
        self::$configuration = $configuration;
    }

    public function run()
    {
        $action = $this -> getData['action'] ?? self::DEFAULT_ACTION;

        switch($action)
        {
            case 'create':
                $page = 'create';
                $created = false;
                if(!empty($this -> postData))
                {
                    $viewPrams = [
                        'title' => $this -> postData['title'],
                        'description' => $this -> postData['descprition']
                    ];
                    $created = true;
                    header('Location: /');
                    $this -> database -> createNote($viewParams);
                }
                $viewParams['created'] = $created;
            break;
            default:
                $page = 'list';
                $viewParams['resultList'] = 'Wyswietlamy listę';
            break;
        }

        $view = new View();
        $view->render($page);
    }
}

?>