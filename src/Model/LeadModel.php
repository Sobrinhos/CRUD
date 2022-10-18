<?php

namespace Youtube\Crud\Model;

use Youtube\Crud\Config\Model;
use Youtube\Crud\Entities\Lead;
use Youtube\Crud\Interfaces\PercistenceInterface;

class LeadModel extends Model implements PercistenceInterface
{
    public function save($lead): int
    {
        $arrayFields = array(
          "id" => null,
          "name" => $lead->getName(),
          "email" => $lead->getEmail()
        );
        return $this->insert("lead", $arrayFields);
    }

    public function findAll()
    {
        return $this->selectAll("lead");
    }

    public function findById(int $id)
    {
        $result = $this->selectWithWhere("lead", array("id" => $id));
        if ($result != false) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function updateById($lead, $id)
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

    public function deleteById(int $id)
    {
        $arrayWhere = array(
            "id" => $id
        );
        return $this->delete("lead", $arrayWhere);
    }
}
