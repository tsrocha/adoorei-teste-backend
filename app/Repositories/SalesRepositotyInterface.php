<?php

namespace App\Repositories;
use App\Services\DTO\CreateSalesDTO;
use App\Services\DTO\UpdateSalesDTO;
use stdClass;
interface SalesRepositotyInterface
{
    public function getAll(): array;
    public function findOne(string $id): stdClass|null;
    public function new(CreateSalesDTO $DTO): stdClass;
    public function update(string $id, UpdateSalesDTO $DTO): stdClass;
    public function delete(string $id): void;
}
