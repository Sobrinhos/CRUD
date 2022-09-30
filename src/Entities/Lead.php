<?php

namespace Youtube\Crud\Entities;

use PDO;
use Youtube\Crud\Database\Database;

class Lead
{
    private $id;
    private $name;
    private $email;
    private $updated_at;
    private $created_at;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function save()
    {
        try {
            $conection = Database::getInstance();
            $insertQuery = $conection->prepare("INSERT INTO `lead` (`id`, `name`, `email`) VALUES (NULL, :name, :email);");

            $insertQuery->bindValue(":name", $this->name);
            $insertQuery->bindValue(":email", $this->email);

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

    public function findAll()
    {
        try {
            $conection = Database::getInstance();
            $selectQuery = $conection->prepare("SELECT * FROM `lead`");

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);
            if ($selectQuery->rowCount() != 0) {
                return $fetchAll;
            } else {
                return "Algo de errado não esta certo";
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    public function updateById(int $id)
    {
        try {
            $conection = Database::getInstance();
            $updateQuery = $conection->prepare("UPDATE `lead` SET name=:name, email=:email, updated_at=CURRENT_TIMESTAMP WHERE id=:id");
            $updateQuery->bindValue(":name", $this->name);
            $updateQuery->bindValue(":email", $this->email);
            $updateQuery->bindValue(":id", $id);

            $resultInsert = $updateQuery->execute();
            $fetchAll = $updateQuery->fetchAll(PDO::FETCH_ASSOC);
          //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);
            if ($updateQuery->rowCount() != 0) {
                return true;
            } else {
                return "Algo de errado não esta certo";
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    public function deleteById(int $id)
    {
        try {
            $conection = Database::getInstance();
            $deleteQuery = $conection->prepare("DELETE FROM `lead` WHERE id=:id");
            $deleteQuery->bindValue(":id", $id);

            $resultInsert = $deleteQuery->execute();
        //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);
            if ($deleteQuery->rowCount() != 0) {
                return true;
            } else {
                return "Algo de errado não esta certo";
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }
}
