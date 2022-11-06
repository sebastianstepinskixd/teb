<?php

declare(strict_type=1);

namespace App;

use PDO;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use PDOException;
use Throwable;
class Database
{
    public function __construct($config)
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $connection = new PDO($dsn);
    }

    private function validateConfig($config)
    {
        if(empty($config['database']) || empty($config['user']) || empty($config['host']))
        {
            throw new ConfigurationException("Porblem z konfiguracją - skontaktuj się z administratorem.");
        }
    }
}