<?php

namespace App\Services;

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


}
