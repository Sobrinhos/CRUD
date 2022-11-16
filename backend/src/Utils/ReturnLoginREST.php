<?php

namespace Youtube\Crud\Utils;

class ReturnLoginREST
{
    public static function return($username, $token)
    {
        return json_encode(
            array(
                "success" => true,
                "username" => $username,
                "message" => "Usuario logado com sucesso",
                "token" => $token
            )
        );
    }
}