<?php

namespace App\Services;
use stdClass;

use App\Repositories\ProductsRepositoryInterface;

class ProductsService
{
    public function __construct(
        protected ProductsRepositoryInterface $repositoty
    ) {}

    public function getAll(string $filter = null): array
    {
        return $this->repositoty->getAll($filter);
    }

    public function findOne(string $id): stdClass
    {
        return $this->repositoty->findOne($id);
    }


}
