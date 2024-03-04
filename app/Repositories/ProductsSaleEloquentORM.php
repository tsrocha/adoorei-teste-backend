<?php

namespace App\Repositories;
use App\Models\Products;
use App\Models\ProductsSale;
use App\Models\Sales;
use App\Services\DTO\CreateProductsSaleDTO;
use App\Services\DTO\UpdateProductsSaleDTO;
use App\Services\DTO\UpdateSalesDTO;
use App\Services\ProductsService;
use stdClass;
use App\Services\DTO\CreateSalesDTO;

class ProductsSaleEloquentORM implements ProductsSaleRepositotyInterface
{
    public function __construct(
        protected ProductsSale $model
    ) {}

    public function getAll(): array
    {
        return $this->model->with('products')->get()->toArray();
    }

    public function getSum(string $sales_id): float
    {
        return $this->model->where('sales_id', '=', $sales_id)->sum('price');
    }

    public function findOne(string $product_id, string $sales_id): stdClass|null
    {

        $product = $this->model->where('product_id', '=', $product_id)
            ->where('sales_id', '=', $sales_id)
            ->first();

        if(!$product) {
            return null;
        }

        return (object) $product->toArray();

    }

    public function new(CreateProductsSaleDTO $DTO): bool
    {

       $this->model->create([
           'product_id' => $DTO->product['product_id'],
           'sales_id' => $DTO->product['sales_id'],
           'name' => $DTO->product['name'],
           'amount' => $DTO->product['amount'],
           'price' => $DTO->product['price']
       ]);

       return true;

    }

    public function update($id, UpdateProductsSaleDTO $DTO): bool
    {
        $this->model->find($id)->update([
            'amount' => $DTO->product['amount'],
            'price' => $DTO->product['price']
        ]);

        return true;
    }

}
