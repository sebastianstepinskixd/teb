<?php

declare(strict_types=1);

spl_autoload_register(function ($name) {
    $name = str_replace(['\\', 'App/'], ['/', ''], $name);
    $path = "src/$name.php";
    require_once($path);
});

//wersja produkcyjna
//error_reporting(0);
//init_set('display_errors', '0');

//require_once('./src/view.php');


include_once('./src/utils/debug.php');
require_once('./config/config.php');

use App\Exception\AppException;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use App\Controller\AbstractController;
use App\Controller\NoteController;
use App\Request;

$request = new Request($_GET, $_POST);

try{
    AbstractController::initConfiguration($configuration);
    $c = new NoteController($request);
    $c -> run();

} catch (AppException $e)
{
    echo "<h1>Wystapił błąd w aplikacji</h1>";
    echo '<h3>' . $e -> getMessage() . '</h3>';
} catch (\Throwable $e)
{
    echo "<h1>Wystapił błąd w aplikacji</h1>";
    echo '<h3>' . $e -> getMessage() . '</h3>';
}


?>