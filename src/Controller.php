<?php

declare(strict_types=1);

namespace App;

require_once('./view.php');

class Controller
{   
    const DEFAULT_ACTION = 'list';

    public function __constuctor()
    {
        $this -> postData = $_POST;
        $this -> getData = $_GET;
    }

    public function run()
    {
        $action = $this -> getData['action'] ?? DEFAULT_ACTION;

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
                }
                $viewParams['created'] = $created;
            break;
            default:
                $page = 'list';
                $viewParams['resultList'] = 'Wyswietlamy listę';
            break;
        }
    }
}

?>