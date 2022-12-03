<?php

declare(strict_types=1);

namespace App;

class View
{
    public function render(?string $page, $params = []): void
    {
        $params['BASE_URL'] = Request::BASE_URL;
        $params = $this -> escape($params);
        require_once('./templates/layout.php');
    }

    private function escape($params)
    {
        $clearParams = [];

        foreach($params as $key => $param) 
        {
            if(is_array($param))
                $clearParams[$key] = $this -> escape($param);
            elseif($param)
                $clearParams[$key] = htmlentities($param);
            else
                $clearParams[$key] = $param;
        }

        return $clearParams;
    }
}
