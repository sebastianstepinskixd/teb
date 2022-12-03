<?php

declare(strict_types=1);

namespace App;

use App\Exception\StorageException;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;
use PDO;
use PDOException;
use Throwable;
class Database
{
    private $conn;

    public function __construct($config)
    {
        try
        {
            $this -> validateConfig($config);
            $this -> createConnection($config);
        }catch(PDOException $e)
        {
            throw new StorageException("connection error");
        }
    }

    private function validateConfig($config)
    {
        if(empty($config['database']) || empty($config['user']) || empty($config['host']))
        {
            throw new ConfigurationException("Porblem z konfiguracją - skontaktuj się z administratorem.");
        }
    }

    private function createNote($data)
    {
        try
        {
            $title = $this -> conn->quote($data['title']);
            $description = $this -> conn->quote($data['description']);
            $created = date("Y-m-d H:i:s");
            $query = "INSERT INTO notes(title,description,created) VALUES($title, $description, '$created')";
            $result = $this -> conn -> exec($query);
        }catch(Throwable $e)
        {
            throw new StorageException("Nie udalo sie utworzyc nowej notatki");
        }
    }

    public function getNote($id)
    {
        try {
            $query = "SELECT * FROM notes WHERE id = " . (int)$id;
            $result = $this -> conn -> query($query);
            $note = $result -> fetch(PDO::FETCH_ASSOC);
        } catch(Throwable $e) {
            throw new StorageException("Nie udalo sie pobrać notatki", 400, $e);
        }

        if(!$note) 
            throw new NotFoundException("Notatka o id: $id nie istnieje");

        return $note;
    }

    public function getNotes()
    {
        try {
            $notes = [];
            $query = "SELECT id,title,created FROM notes";
            $result = $this -> conn -> query($query);
            return $result -> fetchAll(PDO::FETCH_ASSOC);
        } catch(Throwable $e) {
            throw new StorageException("Nie udalo sie pobrać danych o notatkach", 400, $e);
        }
    }

    private function createConnection($config)
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this -> conn = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}