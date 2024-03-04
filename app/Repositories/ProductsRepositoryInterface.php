<?php

namespace App\Repositories;
use stdClass;

interface ProductsRepositoryInterface
{
    public function getAll(): array;
    public function findOne(string $id): stdClass;
}
