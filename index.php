<?php

namespace App;

//wersja produkcyjna
//error_reporting(0);
//init_set('display_errors', '0');

require_once('./src/view.php');
include_once('./src/utils/debug.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$params = [];

if($action == 'create')
{
	$page = 'create';
	$params['resultCreate'] = "Udało się dodać notatkę";
}
else
{
	$page = 'list';
	$params['resultList'] = "Wyświetlono listę notatek";
}

$view = new View();
$view->render($page, $params);

?>