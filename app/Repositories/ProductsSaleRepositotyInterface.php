<?php

namespace App\Repositories;
use App\Services\DTO\CreateProductsSaleDTO;
use App\Services\DTO\UpdateProductsSaleDTO;
use stdClass;
interface ProductsSaleRepositotyInterface
{
    public function getAll(): array;
    public function findOne(string $product_id, string $sales_id): stdClass|null;
    public function getSum(string $sales_id): float;
    public function new(CreateProductsSaleDTO $DTO): bool;
    public function update(string $id, UpdateProductsSaleDTO $DTO): bool;
}
