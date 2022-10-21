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
        return $this->findOne(['id' => $id]);
    }

    public function find(?array $where)
    {
        # code...
    }

    public function findOne(array $where)
    {
        $result = $this->selectWithWhere("user", $where);
        if ($result != false) {
            $newUser = new User($result[0]["username"], $result[0]["password"], $this);
            $newUser->setName($result[0]["name"]);
            return $newUser;
        } else {
            throw new Exception("Usuário não encontrado", 404);
        }
    }

    public function updateById($user, int $id)
    {
    }

    public function deleteById(int $id)
    {
        $arrayWhere = array(
            "id" => $id
        );
        return $this->delete("user", $arrayWhere);
    }
}
