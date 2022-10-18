<?php

namespace Youtube\Crud\Interfaces;

use SebastianBergmann\Type\ObjectType;

interface PercistenceInterface
{
    public function save($object): int;
    public function findAll();
    public function findById(int $id);
    public function updateById($object, int $id);
    public function deleteById(int $id);
}
