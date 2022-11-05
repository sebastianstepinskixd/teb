<?php

namespace App;

//wersja produkcyjna
//error_reporting(0);
//init_set('display_errors', '0');

//require_once('./src/view.php');
require_once('./src/Controller.php');
include_once('./src/utils/debug.php');
require_once('./config/config.php');

Controller::initConfiguration($configuration);

$c = new Controller();
$c -> run();

?>