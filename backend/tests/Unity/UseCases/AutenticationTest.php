<?php

declare(strict_types=1);

namespace Youtube\Crud\Tests\Entities;

use Exception;
use PHPUnit\Framework\TestCase;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;
use Youtube\Crud\UseCases\Autentication;

class AutenticationTest extends TestCase
{
    public function testLoginReturnJsonWhenUsernameAndPasswordIsOk()
    {
        $userPersistence = new UserModel();

        $userCreate = new User("username", "password", $userPersistence);
        $userRusultId = $userCreate->save();

        $returnLogin = Autentication::login("username", "password", UserPersistence: $userPersistence);

        $userCreate->deleteById($userRusultId);
        $this->assertJson($returnLogin, "O Retorno de login não foi um JSON");
    }

    public function testLoginReturnExceptionCode404WhenUsernamePasswordInvalid()
    {
        $userPersistence = new UserModel();

        $userCreate = new User("username", "password", $userPersistence);
        $userRusultId = $userCreate->save();

        try {
            $returnLogin = Autentication::login("username", "password_wrong", UserPersistence: $userPersistence);
        } catch (Exception $error) {
            $returnLogin = $error;
        }

        $userCreate->deleteById($userRusultId);
        $this->assertInstanceOf(Exception::class, $returnLogin);
    }
}
