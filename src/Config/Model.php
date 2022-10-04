<?php

namespace Youtube\Crud\Config;

use PDO;
use Youtube\Crud\Database\Database;

class Model
{
    public function insert(string $table, array $fields): int
    {
        try {
            $conection = Database::getInstance();

            $stringFields = "";
            $stringValues = "";

            foreach ($fields as $field => $value) {
                if (!is_null($value)) {
                    $value = ":" . $field . "";

                    if ($stringFields == "") {
                        $stringFields = "`" . $field . "`";
                    } else {
                        $stringFields .= ", `" . $field . "`";
                    }

                    if ($stringValues == "") {
                        $stringValues = $value;
                    } else {
                        $stringValues .= ", " . $value;
                    }
                }
            }

            $insertQuery = $conection->prepare("INSERT INTO `" . $table . "` (" . $stringFields
            . ") VALUES (" . $stringValues . ");");

            foreach ($fields as $field => $value) {
                if (!is_null($value)) {
                    $insertQuery->bindValue(":" . $field, $value);
                }
            }

            $insertQuery->execute();
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($conection, true) . "\n", FILE_APPEND);
            if ($conection->lastInsertId() != 0) {
                return $conection->lastInsertId();
            } else {
                return 0;
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    public function selectAll(string $table)
    {
        try {
            $conection = Database::getInstance();
            $selectQuery = $conection->prepare("SELECT * FROM " . $table);

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);

            return $fetchAll;
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    public function selectWithWhere(string $table, array $where)
    {
        try {
            $conection = Database::getInstance();

            $stringWhere = "";
            foreach ($where as $field => $value) {
                if (!is_null($value)) {
                    if ($stringWhere == "") {
                        $stringWhere = "`" . $field . "` = :" . $field;
                    } else {
                        $stringWhere .= ", `" . $field . "` = :" . $field;
                    }
                }
            }

            $selectQuery = $conection->prepare("SELECT * FROM `" . $table . "` WHERE " . $stringWhere);

            foreach ($where as $field => $value) {
                if (!is_null($value)) {
                    $selectQuery->bindValue(":" . $field, $value);
                }
            }

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);

            return $fetchAll;
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }
}
