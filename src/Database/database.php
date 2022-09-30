<?php

namespace Youtube\Crud\Database;

use Exception;
use PDO;

class Database
{
    public static function getInstance()
    {
        try {
            return new PDO("mysql:dbname=crud_youtube;host=localhost;port=3306", "root");
        } catch (\Throwable $error) {
            file_put_contents("E:/Projetos/youtube/CRUD/debugDatabase.txt", print_r($error->getMessage(), true) . "\n", FILE_APPEND);
            throw new Exception("Error Processing Request", 1);
        }
    }
}
