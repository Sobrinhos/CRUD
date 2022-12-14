<?php

declare(strict_types=1);

namespace Youtube\Crud\Interfaces;

interface PersistenceInterface
{
    public function save($object): int;
    public function findAll();
    public function findById(int $id);
    public function find(array $where);
    public function findOne(array $where);
    public function updateById($object, int $id);
    public function deleteById(int $id);
}
