<?php

namespace Youtube\Crud\Controller;

use Exception;
use Youtube\Crud\Entities\User;
use Youtube\Crud\Model\UserModel;

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
            "message" => "Usuario logado com sucesso"
            );

            echo json_encode($result);
        } catch (Exception $error) {
            throw $error;
        }
    }
}
