<?php

namespace App;

require_once('./src/view.php');
include_once('./src/utils/debug.php');

const DEFAULT_ACTION = 'list';

$action = $_GET['action'] ?? DEFAULT_ACTION;

$params = [];

if($action == 'create')
	$params['resultCreate'] = "Udało się dodać notatkę";
else
	$params['resultList'] = "Wyświetlono listę notatek";

$view = new View();
$view->render($action, $params);

?>