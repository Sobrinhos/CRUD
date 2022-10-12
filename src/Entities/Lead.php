<?php

namespace Youtube\Crud\Entities;

use Youtube\Crud\Model\LeadModel;

class Lead extends LeadModel
{
    private $id;
    private $name;
    private $email;
    private $updated_at;
    private $created_at;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function save()
    {
        return $this->saveLead($this);
    }

    public function findAll()
    {
        return $this->findAllLeads();
    }

    public function findById(int $id)
    {
        return $this->findByIdLead($id);
    }

    public function updateById(int $id)
    {
        return $this->updateLeadById($this, $id);
    }

    public function deleteById(int $id)
    {
        return $this->deleteLeadById($id);
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
