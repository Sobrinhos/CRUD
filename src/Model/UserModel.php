<?php

namespace Youtube\Crud\Model;

use Youtube\Crud\Interfaces\PersistenceInterface;

class UserModel implements PersistenceInterface
{
    public function save($user): int
    {
        return 0;
    }

    public function findAll()
    {
        return array();
    }

    public function findById(int $id)
    {
    }

    public function updateById($user, int $id)
    {
    }

    public function deleteById(int $id)
    {
    }
}
