<?php

namespace App\Repositories;

use App\Models\Products;
use stdClass;

class ProductEloquentORM implements ProductsRepositoryInterface
{
    public function __construct(
        protected Products $model
    ) {}

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function findOne(string $id): stdClass
    {
        return (object) $this->model->find($id)->toArray();
    }

}
