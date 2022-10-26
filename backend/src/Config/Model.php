<?php

declare(strict_types=1);

namespace Youtube\Crud\Config;

use Exception;
use PDO;
use PDOStatement;
use Youtube\Crud\Database\Database;

class Model
{
    public function insert(string $table, array $fields): int
    {
        try {
            $conection = Database::getInstance();

            $stringFields = $this->getStringFields($fields);
            $stringValues = $this->getStringValues($fields);

            $insertQuery = $conection->prepare("INSERT INTO `" . $table . "` (" . $stringFields
            . ") VALUES (" . $stringValues . ");");

            $this->bindValues($fields, $insertQuery);

            $insertQuery->execute();
            if ($conection->lastInsertId() != 0) {
                return (int) $conection->lastInsertId();
            } else {
                return (int) 0;
            }
        } catch (Exception $error) {
            throw $error;
        }
    }

    public function selectAll(string $table)
    {
        try {
            $conection = Database::getInstance();
            $selectQuery = $conection->prepare("SELECT * FROM `" . $table . "`");

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);

            return $fetchAll;
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function selectWithWhere(string $table, array $where)
    {
        try {
            $conection = Database::getInstance();

            $stringWhere = $this->getStringWhere($where);

            $selectQuery = $conection->prepare("SELECT * FROM `" . $table . "` WHERE " . $stringWhere);

            $this->bindValues($where, $selectQuery);

            $resultInsert = $selectQuery->execute();
            $fetchAll = $selectQuery->fetchAll(PDO::FETCH_ASSOC);
            //file_put_contents("E:/Projetos/youtube/CRUD/debug1.txt", print_r($fetchAll, true) . "\n", FILE_APPEND);

            return $fetchAll;
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function update(string $table, array $fields, array $where)
    {
        try {
            $conection = Database::getInstance();

            $stringFields = $this->getStringFieldsUpdate($fields);

            $stringWhere = $this->getStringWhere($where);

            $updateQuery = $conection->prepare(
                "UPDATE `" . $table . "` SET " . $stringFields . " WHERE " . $stringWhere
            );

            $this->bindValues(array_merge($fields, $where), $updateQuery);

            $resultInsert = $updateQuery->execute();
            $fetchAll = $updateQuery->fetchAll(PDO::FETCH_ASSOC);
            file_put_contents("E:/Projetos/youtube/CRUD/debugDatabase.txt", print_r($updateQuery, true) . "\n", FILE_APPEND);
            if ($updateQuery->rowCount() != 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function delete(string $table, array $where)
    {
        try {
            $conection = Database::getInstance();

            $stringWhere = $this->getStringWhere($where);
            $deleteQuery = $conection->prepare("DELETE FROM `" . $table . "` WHERE " . $stringWhere);

            $this->bindValues($where, $deleteQuery);
            // foreach ($where as $field => $value) {
            //     if (!is_null($value)) {
            //         $deleteQuery->bindValue(":" . $field, $value);
            //     }
            // }

            $resultInsert = $deleteQuery->execute();
            if ($deleteQuery->rowCount() != 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $error) {
            throw $error;
        }
    }

    private function getStringFields(array $fields)
    {
        $result = "";
        foreach ($fields as $field => $value) {
            if (!is_null($value)) {
                $value = ":" . $field . "";

                if ($result == "") {
                    $result = "`" . $field . "`";
                } else {
                    $result .= ", `" . $field . "`";
                }
            }
        }
        return $result;
    }

    private function getStringValues(array $fields)
    {
        $result = "";
        foreach ($fields as $field => $value) {
            if (!is_null($value)) {
                $value = ":" . $field . "";

                if ($result == "") {
                    $result = $value;
                } else {
                    $result .= ", " . $value;
                }
            }
        }
        return $result;
    }

    private function getStringFieldsUpdate(array $fields)
    {
        $result = "";
        foreach ($fields as $field => $value) {
            if (!is_null($value)) {
                $value = ":" . $field . "";

                if ($result == "") {
                    $result = "`" . $field . "` =:" . $field;
                } else {
                    $result .= ", `" . $field . "` =:" . $field;
                }
            }
        }
        return $result;
    }

    private function getStringWhere(array $where)
    {
        $result = "";
        foreach ($where as $field => $value) {
            if (!is_null($value)) {
                if ($result == "") {
                    $result = "`" . $field . "` = :" . $field;
                } else {
                    $result .= ", `" . $field . "` = :" . $field;
                }
            }
        }
            return $result;
    }

    private function bindValues(array $bindValues, PDOStatement $statement)
    {
        foreach ($bindValues as $field => $value) {
            if (!is_null($value)) {
                $statement->bindValue(":" . $field, $value);
            }
        }
    }
}
