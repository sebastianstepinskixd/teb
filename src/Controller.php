<?php

declare(strict_types=1);

namespace App;

use App\Exception\NotFoundException;

include_once('./src/view.php');
require_once('./config/config.php');
require_once('./src/Database.php');

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
                    exit;
                }
            break;
            case 'show':
                $page = 'show';
                $data = $this->getRequestGet();
                $noteId = (int) $data['id'] ?? null;
                if(!$noteId) {
                    header('Location: /?error=missingNoteId');
                    exit;
                }
                try {
                    $note = $this -> database->getNote($noteId);
                } catch (NotFoundException $e) {  
                    header('Location: /?error=noteNotFound');
                    exit;
                }
                $viewParams = [
                    'title' => "Moja notatka",
                    'description' => "Opis",
                    "note" => $note
                ];
            break;
            default:
                $page = 'list';
                $data = $this -> getRequestGet();
                $viewParams = [
                    'notes' => $this -> database -> getNotes(),
                    'before' => $data['before'] ?? null,
                    'error' => $data['error'] ?? null
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