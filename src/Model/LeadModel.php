<?php

namespace Youtube\Crud\Model;

use Youtube\Crud\Config\Model;
use Youtube\Crud\Entities\Lead;

class LeadModel extends Model
{
    protected function saveLead(Lead $lead): int
    {
        $arrayFields = array(
          "id" => null,
          "name" => $lead->getName(),
          "email" => $lead->getEmail()
        );
        return $this->insert("lead", $arrayFields);
    }

    protected function findAllLeads()
    {
        return $this->selectAll("lead");
    }

    protected function findByIdLead(int $id)
    {
        $result = $this->selectWithWhere("lead", array("id" => $id));
        if ($result != false) {
            return $result[0];
        } else {
            return false;
        }
    }

    protected function updateLeadById(Lead $lead, $id)
    {
        $arrayFields = array(
            "name" => $lead->getName(),
            "email" => $lead->getEmail()
          );

        $arrayWhere = array(
            "id" => $id
        );
        return $this->update("lead", $arrayFields, $arrayWhere);
    }

    protected function deleteLeadById(int $id)
    {
        $arrayWhere = array(
            "id" => $id
        );
        return $this->delete("lead", $arrayWhere);
    }
}
