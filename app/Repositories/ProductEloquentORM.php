<?php

namespace App\Repositories;

use App\Models\Products;

class ProductEloquentORM implements ProductsRepositoryInterface
{
    public function __construct(
        protected Products $model
    ) {}

    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

}
