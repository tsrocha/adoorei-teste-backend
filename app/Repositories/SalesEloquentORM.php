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
        return $this->model->with('sale')->get()->toArray();
    }
    public function findOne(string $id): stdClass|null
    {
        $sale = $this->model->with('sale')->find($id);
        if(!$sale) {
            return null;
        }

        return (object) $sale->toArray();
    }

    public function delete(string $id): void
    {
        $sale = $this->model->findOrFail($id);
        $sale->delete();
    }


    public function new(CreateSalesDTO $DTO): stdClass
    {

    }



}
