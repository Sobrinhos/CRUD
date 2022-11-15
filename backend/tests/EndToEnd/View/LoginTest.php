<?php

namespace Youtube\Crud\Tests\Entities\LoginTest;

use PHPUnit\Framework\TestCase;
use Youtube\Crud\Controller\UserController;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;
use Youtube\Crud\Utils\Curl;

class LoginTest extends TestCase
{
    public function testLoginReturnStatusCode200WhenUserAndPassIsOk()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();
        $body = array(
            "username" => "teste",
            "password" => "pass"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $userCreate->deleteById($userRusultId);
        $this->assertEquals(200, $result->getStatusCode(), "Retornou diferente de 200");
    }

    public function testLoginReturnStatusCode404WhenUserAndPassNotMatch()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();

        $body = array(
            "username" => "teste",
            "password" => "wrong_pass"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $userCreate->deleteById($userRusultId);
        $this->assertEquals(404, $result->getStatusCode(), "Retornou diferente de 404");
    }

    public function testLoginReturnATokenWhenUserAndPassIsOk()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();
        $body = array(
            "username" => "teste",
            "password" => "pass"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $outputArray = json_decode($result->getOutput());

        $userCreate->deleteById($userRusultId);
        $this->assertObjectHasAttribute("token", $outputArray);
    }

    public function testLoginTokenNotIsVoid()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();
        $body = array(
            "username" => "teste",
            "password" => "pass"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $outputArray = json_decode($result->getOutput());

        $userCreate->deleteById($userRusultId);
        $this->assertNotEquals("", $outputArray, "O Token retornou vazio");
    }

    public function testLoginTokenIsUnique()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();
        $body = array(
            "username" => "teste",
            "password" => "pass"
        );
        $bodyJson = json_encode($body);
        $resultOne = Curl::post("127.0.0.1:8000/login", $bodyJson);
        sleep(1);
        $resultTwo = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $outputArrayOne = json_decode($resultOne->getOutput());
        $outputArrayTwo = json_decode($resultTwo->getOutput());

        $userCreate->deleteById($userRusultId);
        $this->assertNotEquals($outputArrayOne->token, $outputArrayTwo->token, "Os tokens gerados não são unicos");
    }

    public function testLoginTokenIsValid()
    {
        $userPersistence = new UserModel();
        $userCreate = new User("teste", "pass", $userPersistence);
        $userRusultId = $userCreate->save();
        $body = array(
            "username" => "teste",
            "password" => "pass"
        );
        $bodyJson = json_encode($body);
        $result = Curl::post("127.0.0.1:8000/login", $bodyJson);

        $outputArray = json_decode($result->getOutput());
        $token = $outputArray->token;

        $userCreate->deleteById($userRusultId);
        $this->assertTrue((new UserController())->verifyToken($token), "O token gerado não é valido para este usuário");
    }
}