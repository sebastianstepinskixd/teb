<?php

declare(strict_types=1);

namespace App;

use App\Exception\NotFoundException;
use App\Request;

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

    public function __construct(Request $request)
    {
        $this -> request = $request;
        $this -> database = new Database(self::$configuration);
        $this -> action = $this -> action();
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
                if($this -> request -> hasPost())
                {
                    $noteData = [
                        'title' => $this -> request ->postParam('title'),
                        'description' => $this -> request ->postParam('descprition')
                    ];
                    $this -> database -> createNote($noteData);
                    header('Location: /?before=created');
                    exit;
                }
            break;
            case 'show':
                $page = 'show';
                $noteId = (int) $this -> request ->getParam('id') ?? null;
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
                $viewParams = [
                    'notes' => $this -> database -> getNotes(),
                    'before' => $this -> request ->getParam('before'),
                    'error' => $this -> request ->getParam('error')
                ];
            break;
        }

        $view = new View();
        $view->render($page, $viewParams ?? []);
    }

    private function action()
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}

?>