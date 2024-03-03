<?php

namespace App\Services;

class ProductsService
{
    public function __construct()
    {

    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }


}
