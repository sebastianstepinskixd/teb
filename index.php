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
	if(!empty($_POST))
	{
		$viewPrams = [
			'title' => $_POST['title'],
			'description' => $_POST['descprition']
		];
		$created = true;
	}
	$viewParams['created'] = $created;
}
else
{
	$page = 'list';
}

$view = new View();
$view->render($page);

?>