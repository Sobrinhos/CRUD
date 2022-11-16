<?php
declare(strict_types=1);

namespace Youtube\Crud\Controller;

use Exception;
use Youtube\Crud\UseCases\Subscribe;

class LeadController
{
    public function subscribe()
    {
        $jsonBody = file_get_contents('php://input');
        $jsonDecoded = json_decode($jsonBody);

        try {
            if (!is_object($jsonDecoded) || !property_exists($jsonDecoded, 'email')) {
                throw new Exception("Formato invalido ou a propriedade email não existe.", 406);
            }
            
            echo Subscribe::subscribe($jsonDecoded->email);
        } catch (Exception $error) {
            throw $error;
        }
    }
}
