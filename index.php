<?php

namespace App;

//wersja produkcyjna
//error_reporting(0);
//init_set('display_errors', '0');

//require_once('./src/view.php');


require_once('./Exception/AppException.php');
require_once('./Exception/StorageException.php');
require_once('./Exception/ConfigurationException.php');
require_once('./src/Controller.php');
require_once('./src/Request.php');
include_once('./src/utils/debug.php');
require_once('./config/config.php');

use App\Exception\AppException;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use App\Request;
use Throwable;

$request = new Request($_GET, $_POST);

try{
    Controller::initConfiguration($configuration);
    $c = new Controller();
    $c -> run();

} catch (AppException $e)
{
    echo "<h1>Wystapił błąd w aplikacji</h1>";
    echo '<h3>' . $e -> getMessage() . '</h3>';
} catch (Throwable $e)
{
    echo "<h1>Wystapił błąd w aplikacji</h1>";
}


?>