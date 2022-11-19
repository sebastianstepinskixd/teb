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
                $data = $this -> getRequestPost();
                if(!empty($data))
                {
                    $noteData = [
                        'title' => $data['title'],
                        'description' => $data['descprition']
                    ];
                    $this -> database -> createNote($noteData);
                    header('Location: /?before=created');
                }
            break;
            default:
                $page = 'list';
                $data = $this -> getRequestGet();
                $viewParams = [
                    'notes' => $this -> database -> getNotes(),
                    'before' => $data['before'] ?? null
                ];
            break;
        }

        $view = new View();
        $view->render($page, $viewParams ?? []);
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