<?php

namespace App\Repositories;
use App\Models\Sales;
use App\Models\SalesHasProducts;
use stdClass;
use App\Services\DTO\CreateSalesDTO;

class SalesEloquentORM implements SalesRepositotyInterface
{
    public function __construct(
        protected Sales $model,
        protected SalesHasProducts $relationship
    ) {}

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }
    public function findOne(string $id): stdClass|null
    {
        return $this->model->where('id', '=', $id)->get();
    }

    public function new(CreateSalesDTO $DTO): stdClass
    {
        
    }

}
