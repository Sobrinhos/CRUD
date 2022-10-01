<?php

namespace Youtube\Crud\Config;

use Youtube\Crud\Database\Database;

class Model
{
    public function save(): int
    {
        try {
            $conection = Database::getInstance();
            $insertQuery = $conection->prepare("INSERT INTO `lead` (`id`, `name`, `email`) VALUES (NULL, :name, :email);");

            $insertQuery->bindValue(":name", $this->getName());
            $insertQuery->bindValue(":email", $this->getEmail());

            $resultInsert = $insertQuery->execute();
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($conection, true) . "\n", FILE_APPEND);
            if ($conection->lastInsertId() != 0) {
                return $conection->lastInsertId();
            } else {
                return "Algo de errado não esta certo";
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }
}
