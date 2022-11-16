<?php

declare(strict_types=1);

namespace Youtube\Crud\UseCases;

use Youtube\Crud\Entities\Lead;
use Youtube\Crud\Model\LeadModel;

class Subscribe  
{
    public static function subscribe($email)
    {
        $leadModel = new LeadModel();
        $lead = new Lead($email, $leadModel);
        $id = $lead->save();

        if ($id > 0) {
            $success = true;
        } else {
            $success = false;
        }

        return array(
        "success" => $success,
        "id" => $id,
        "message" => "Lead gravado com sucesso"
        );
    }
}
