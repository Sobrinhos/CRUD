<?php

declare(strict_types=1);

namespace Youtube\Crud\Tests\Entities;

use Exception;
use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;

class UserTest extends TestCase
{
    public function testWhenCreateNewUserShouldUsernameAndPassword()
    {
        $userPersistence = new UserModel();
        $user = new User("username", "password", $userPersistence);

        $this->assertIsString($user->getUsername());
    }

    public function testSaveShouldReturnNewInsertID()
    {
        $userPersistence = new UserModel();
        $user = new User("username", "password", $userPersistence);
        $userRusultId = $user->save();
        $user->deleteById($userRusultId);
        $this->assertIsInt($userRusultId);

        $user = new User("gustavo", "teste", $userPersistence);
        $userRusultId = $user->save();
    }

    public function testSaveIdShouldSaveInDatabase()
    {
        $userPersistence = new UserModel();
        $user = new User("username", "password", $userPersistence);
        $userRusultId = $user->save();

        $leadResultFindById = $user->findById($userRusultId);
        $user->deleteById($userRusultId);
        $this->assertInstanceOf(User::class, $leadResultFindById);
    }
}
