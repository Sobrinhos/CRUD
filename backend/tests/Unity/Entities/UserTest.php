<?php

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

    public function testLoginReturnUserIntanceWhenUsernameAndPasswordIsOk()
    {
        $userPersistence = new UserModel();

        $userCreate = new User("username", "password", $userPersistence);
        $userRusultId = $userCreate->save();

        $user = new User("username", "password", UserPersistence: $userPersistence);
        $returnLogin = $user->login();
        $user->deleteById($userRusultId);
        $this->assertInstanceOf(User::class, $returnLogin);
    }

    public function testLoginReturnExceptionCode404WhenUsernamePasswordInvalid()
    {
        $userPersistence = new UserModel();

        $userCreate = new User("username", "password", $userPersistence);
        $userRusultId = $userCreate->save();

        $user = new User("username", "password_wrong", UserPersistence: $userPersistence);
        try {
            $returnLogin = $user->login();
        } catch (Exception $error) {
            $returnLogin = $error;
        }

        $user->deleteById($userRusultId);
        $this->assertInstanceOf(Exception::class, $returnLogin);
    }
}
