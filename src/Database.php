<?php

declare(strict_type=1);

namespace App;

use PDO;

class Database
{
    public function __construct($config)
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $connection = new PDO($dsn);
    }
}