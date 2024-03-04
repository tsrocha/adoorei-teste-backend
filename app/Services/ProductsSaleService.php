<?php

namespace App\Services;

use App\Services\DTO\UpdateProductsSaleDTO;
use stdClass;
use App\Repositories\ProductsSaleRepositotyInterface;
use App\Services\DTO\CreateProductsSaleDTO;

class ProductsSaleService
{
    public function __construct(
        protected ProductsSaleRepositotyInterface $repositoty
    ) {}

    public function getAll(string $filter = null): array
    {
        return $this->repositoty->getAll($filter);
    }

    public function findOne(string $product_id, string $sales_id): stdClass|null
    {
        return $this->repositoty->findOne($product_id, $sales_id);
    }

    public function getSum(string $sales_id): float
    {
        return $this->repositoty->getSum($sales_id);
    }

    public function new(
        CreateProductsSaleDTO $DTO
    ): bool
    {
        return $this->repositoty->new($DTO);
    }

    public function update(
        string $id,
        UpdateProductsSaleDTO $DTO
    ): bool
    {
        return $this->repositoty->update($id, $DTO);
    }


}
