<?php

declare(strict_types=1);

namespace App;

require_once('./src/view.php');

class Controller
{   
    const DEFAULT_ACTION = 'list';
    private static $configuration = [];
    private $database;
    private $request;
    private $view;

    public function __constuctor()
    {
        $this -> request = [
            'get' => $_GET,
            'post' => $_POST
        ];
        $this -> database = new Database(self::$configuration);
    }

    public static function initConfiguration($configuration)
    {
        self::$configuration = $configuration;
    }

    public function run()
    {
        switch($this -> action)
        {
            case 'create':
                $page = 'create';
                $created = false;
                $data = $this -> getRequestPost();
                if(!empty($data))
                {
                    $viewPrams = [
                        'title' => $data['title'],
                        'description' => $data['descprition']
                    ];
                    $created = true;
                    $this -> database -> createNote($viewParams);
                    header('Location: /');
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

    private function getRequestPost()
    {
        return $this -> request['post'] ?? [];
    }

    private function getRequestGet()
    {
        return $this -> request['get'] ?? [];
    }
}

?>