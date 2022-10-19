<?php

namespace Youtube\Crud\Model;

use Exception;
use Youtube\Crud\Config\Model;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Interfaces\PersistenceInterface;

class UserModel extends Model implements PersistenceInterface
{
    public function save($user): int
    {
        $arrayFields = array(
            "id" => null,
            "name" => $user->getName(),
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
          );
          return $this->insert("user", $arrayFields);
    }

    public function findAll()
    {
        return array();
    }

    public function findById(int $id): User
    {
        $result = $this->selectWithWhere("user", array("id" => $id));
        if ($result != false) {
            return new User($result[0]["username"], $result[0]["password"], $result[0]["name"], $this);
        } else {
            throw new Exception("Usuário não encontrado", 404);
        }
    }

    public function updateById($user, int $id)
    {
    }

    public function deleteById(int $id)
    {
    }
}
