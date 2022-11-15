<?php

namespace Youtube\Crud\Controller;

use DateTimeImmutable;
use Exception;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;

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
            $user = new User($jsonDecoded->username, $jsonDecoded->password, $userModel);
            $user = $user->login();

            $result =  array(
                "success" => true,
                "username" => $user->getUsername(),
                "message" => "Usuario logado com sucesso",
                "token" => $this->generateToken($user->getUsername())
            );

            echo json_encode($result);
        } catch (Exception $error) {
            throw $error;
        }
    }

    private function generateToken(string $username): string
    {
        $secret_Key  = '68V0zWFrS72GbpPreidkQFLfj4v9m3Ti+DXc8OB0gcM=';
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
        $domainName = "your.domain.name";
        $username   = "username";                                           // Retrieved from filtered POST data
        $request_data = [
            'iat'  => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss'  => $domainName,                       // Issuer
            'nbf'  => $date->getTimestamp(),         // Not before
            'exp'  => $expire_at,                           // Expire
            'userName' => $username,                     // User name
        ];
        
        return JWT::encode(
            $request_data,
            $secret_Key,
            'HS512'
        );
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
