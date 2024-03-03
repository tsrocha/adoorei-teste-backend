<?php

namespace App\Services;
use stdClass;

class SalesService
{

    public function __construct()
    {

    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function new(
        array $products
    ): stdClass
    {
        return $this->repository->new($products);
    }

}
