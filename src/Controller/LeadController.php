<?php

namespace Youtube\Crud\Controller;

use Youtube\Crud\Entities\Lead;

class LeadController
{
    public function subscribe()
    {
        $jsonBody = file_get_contents('php://input');
        $jsonDecoded = json_decode($jsonBody);

        $lead = new Lead($jsonDecoded->email);
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

        return json_encode($result);
    }
}
