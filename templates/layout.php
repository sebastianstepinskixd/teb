<?php
 
declare(strict_types=1);
 
namespace App;
 
include_once('./src/utils/debug.php');
 
// $_GET - obsług zapytań
// $_POST
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = null;
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="public/style.css" rel="stylesheet">
</head>
 
<body>
    <header>
        <h1>Moje notatki</h1>
    </header>
 
    <main>
        <nav>
            <ul>
                <li>
                    <a href="<?php echo $params['BASE_URL'] ?>">Lista notatek</a>
                </li>
                <li>
                    <a href="<?php echo $params['BASE_URL'] ?>?action=create">Nowa notatka</a>
                </li>
            </ul>
        </nav>
        <article>
            <?php if ($action === 'create') : ?>
                <h3>Nowa notatka</h3>
            <?php else : ?>
                <h3>Lista notatek</h3>
            <?php endif; ?>

            <?php 
                require_once("./templates/pages/$page.php");
            ?>
        </article>
    </main>
 
    <footer>Stopka</footer>
</body>
 
</html>