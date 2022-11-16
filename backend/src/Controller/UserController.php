<?php

declare(strict_types=1);

namespace Youtube\Crud\Controller;

use DateTimeImmutable;
use Exception;
use Youtube\Crud\Model\UserModel;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Youtube\Crud\UseCases\Autentication;
use Youtube\Crud\Utils\ReturnLoginREST;

class UserController
{
    public function login()
    {
        $jsonBody = file_get_contents('php://input');
        $jsonDecoded = json_decode($jsonBody);
        try {
            if (!is_object($jsonDecoded) || !property_exists($jsonDecoded, 'username') || !property_exists($jsonDecoded, 'password')) {
                throw new Exception("Formato invalido ou as propriedades username ou password não existem", 406);
            }
            $userModel = new UserModel();
            echo Autentication::login($jsonDecoded->username, $jsonDecoded->password, $userModel);
        } catch (Exception $error) {
            throw $error;
        }
    }

    public function verifyToken(string $token)
    {
        $secret_Key  = '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=';
        $token = JWT::decode($token, new Key($secret_Key, 'HS512'));
        $now = new DateTimeImmutable();
        $serverName = "your.domain.name";

        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp())
        {
            return false;
        }else{
            return true;
        }
        
    }
}
