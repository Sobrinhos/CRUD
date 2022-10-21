<?php

declare(strict_types=1);

namespace Youtube\Crud\Entities;

use Exception;
use Youtube\Crud\Interfaces\PersistenceInterface;

class User
{
    private int $id;
    private string $username;
    private string $password;
    private string $name = "";
    private PersistenceInterface $userPersistence;

    public function __construct(string $username, string $password, PersistenceInterface $UserPersistence)
    {
        $this->username = $username;
        $this->password = $password;
        $this->userPersistence = $UserPersistence;
    }

    public function save(): int
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return $this->userPersistence->save($this);
    }

    public function findById(int $id): User
    {
        $userFind = $this->userPersistence->findById($id);
        return $userFind;
    }

    public function login(): User
    {
        $userFind = $this->userPersistence->findOne(['username' => $this->username]);
        $returnVerifyPassword = $this->verifyLogin($this->password, $userFind->getPassword());
        if ($returnVerifyPassword) {
            return $userFind;
        } else {
            throw new Exception("Usuario ou senha invalidos", 404);
        }
    }

    private function verifyLogin($password, $hash): bool
    {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteById(int $id)
    {
        return $this->userPersistence->deleteById($id);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
