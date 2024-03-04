<?php

namespace App\Services;
use App\Repositories\SalesRepositotyInterface;
use App\Services\DTO\CreateSalesDTO;
use App\Services\DTO\UpdateSalesDTO;
use stdClass;

class SalesService
{

    public function __construct(
        protected SalesRepositotyInterface $repositoty
    ) {}

    public function getAll(string $filter = null): array
    {
        return $this->repositoty->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repositoty->findOne($id);
    }

    public function new(
        CreateSalesDTO $DTO
    ): stdClass
    {
        return $this->repositoty->new($DTO);
    }

    public function update(
        string $id,
        UpdateSalesDTO $DTO
    ): stdClass
    {
        return $this->repositoty->update($id, $DTO);
    }

    public function delete(string $id): void
    {
        $this->repositoty->delete($id);
    }

}
