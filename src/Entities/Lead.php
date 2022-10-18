<?php

namespace Youtube\Crud\Entities;

use Exception;
use Youtube\Crud\Interfaces\PercistenceInterface;
use Youtube\Crud\Percistence\LeadPercistence;

class Lead
{
    private $id;
    private $name;
    private $email;
    private $updated_at;
    private $created_at;
    private $leadPercistence;

    public function __construct(string $email, PercistenceInterface $leadPercistence)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("Email não informado", 1);
        }

        $this->leadPercistence = $leadPercistence;
    }

    public function save()
    {
        return $this->leadPercistence->save($this);
        // return $this->saveLead($this);
    }

    public function findAll()
    {
        return $this->leadPercistence->findAll();
    }

    public function findById(int $id)
    {
        return $this->leadPercistence->findById($id);
    }

    public function updateById(int $id)
    {
        return $this->leadPercistence->updateById($this, $id);
    }

    public function deleteById(int $id)
    {
        return $this->leadPercistence->deleteById($id);
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
