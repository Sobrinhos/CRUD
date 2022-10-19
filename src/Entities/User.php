<?php

declare(strict_types=1);

namespace Youtube\Crud\Entities;

use Youtube\Crud\Interfaces\PersistenceInterface;

class User
{
    private string $username;
    private string $password;
    private string $name;
    private PersistenceInterface $userPercistence;

    public function __construct(string $username, string $password, string $name, PersistenceInterface $UserPercistence)
    {
        $this->username = $username;
        $this->name = $name;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->userPercistence = $UserPercistence;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
