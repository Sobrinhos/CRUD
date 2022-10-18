<?php

namespace Youtube\Crud\Controller;

use Exception;
use Throwable;
use Youtube\Crud\Entities\Lead;
use Youtube\Crud\Model\LeadModel;

class LeadController
{
    public function subscribe()
    {
        $jsonBody = file_get_contents('php://input');
        $jsonDecoded = json_decode($jsonBody);


        try {
            if (!is_object($jsonDecoded) || !property_exists($jsonDecoded, 'email')) {
                throw new Exception("Formato invalido ou a propriedade email não existe.", 1);
            }
            $leadModel = new LeadModel();
            $lead = new Lead($jsonDecoded->email, $leadModel);
            $id = $lead->save();

            if ($id > 0) {
                $success = true;
            } else {
                $success = false;
            }

            $result =  array(
            "success" => $success,
            "id" => $id,
            "message" => "Lead gravado com sucesso"
            );

            echo json_encode($result);
        } catch (Throwable $error) {
            http_response_code(406);
            $result =  array(
                "success" => false,
                "message" => $error->getMessage()
            );

            echo json_encode($result);
        }
    }
}
