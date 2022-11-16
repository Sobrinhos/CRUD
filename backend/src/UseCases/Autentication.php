<?php

declare(strict_types=1);

namespace Youtube\Crud\UseCases;

use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Interfaces\PersistenceInterface;
use Youtube\Crud\Utils\ReturnLoginREST;

class Autentication
{
    public static function login(string $username, string $password, PersistenceInterface $UserPersistence): string
    {
        $userFind = $UserPersistence->findOne(['username' => $username]);
        $returnVerifyPassword = Autentication::verifyLogin($password, $userFind->getPassword());
        if ($returnVerifyPassword) {
            return ReturnLoginREST::return($userFind->getUsername(), Autentication::generateToken($userFind->getUsername()));
        } else {
            throw new Exception("Usuario ou senha invalidos", 404);
        }
    }

    public static function verifyLogin($password, $hash): bool
    {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    

    public static function generateToken(string $username): string
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
}
