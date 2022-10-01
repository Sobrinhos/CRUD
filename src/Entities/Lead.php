<?php

namespace Youtube\Crud\Entities;

use PDO;
use Youtube\Crud\Config\Model;
use Youtube\Crud\Database\Database;

class Lead extends Model
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

    public function findById(int $id)
    {
        try {
            $conection = Database::getInstance();
            $selectQuery = $conection->prepare("SELECT * FROM `lead` WHERE `id` = :id");
            $selectQuery->bindValue(":id", $id);

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);
            if ($selectQuery->rowCount() != 0) {
                return $fetchAll[0];
            } else {
                return false;
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
            if ($deleteQuery->rowCount() != 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }
}
