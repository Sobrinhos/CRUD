<?php

namespace Youtube\Crud\Tests\Entities;

use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;

class UserTest extends TestCase
{
    public function testWhenCreateNewUserShouldUsernameAndPassword()
    {
        $userPercistence = new UserModel();
        $user = new User("username", "password", "name", $userPercistence);

        $this->assertIsString($user->getUsername());
    }

    public function testSaveShouldReturnNewInsertID()
    {
        $userPercistence = new UserModel();
        $user = new User("username", "password", "name", $userPercistence);

        $this->assertIsInt($user->save());
    }

    public function testSaveIdShouldSaveInDatabase()
    {
        $userPercistence = new UserModel();
        $user = new User("username", "password", "name", $userPercistence);
        $userRusultId = $user->save();

        $leadResultFindById = $user->findById($userRusultId);
        // $user->deleteById($userRusultId);
        $this->assertInstanceOf(User::class, $leadResultFindById);
    }
}
