<?php

declare(strict_types=1);

namespace Youtube\Crud\Entities;

use DateTime;
use Exception;
use Youtube\Crud\Interfaces\PersistenceInterface;

class Lead
{
    private int $id;
    private string $name = "";
    private string $email;
    private DateTime $updated_at;
    private DateTime $created_at;
    private PersistenceInterface $leadPercistence;

    public function __construct(string $email, PersistenceInterface $leadPercistence)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("Email não informado", 406);
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
