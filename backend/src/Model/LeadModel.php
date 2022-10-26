<?php

declare(strict_types=1);

namespace Youtube\Crud\Model;

use Youtube\Crud\Config\Model;
use Youtube\Crud\Interfaces\PersistenceInterface;

class LeadModel extends Model implements PersistenceInterface
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

    public function find(?array $where)
    {
        # code...
    }

    public function findOne(array $where)
    {
        $result = $this->selectWithWhere("lead", $where);
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
