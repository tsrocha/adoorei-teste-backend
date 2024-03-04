<?php

namespace App\Repositories;
use App\Models\Products;
use App\Models\ProductsSale;
use App\Models\Sales;
use App\Services\DTO\CreateProductsSaleDTO;
use App\Services\DTO\UpdateProductsSaleDTO;
use App\Services\DTO\UpdateSalesDTO;
use App\Services\ProductsSaleService;
use App\Services\ProductsService;
use stdClass;
use App\Services\DTO\CreateSalesDTO;

class SalesEloquentORM implements SalesRepositotyInterface
{
    public function __construct(
        protected Sales $model,
        protected ProductsService $products,
        protected ProductsSaleService $productsSale
    ) {}

    public function getAll(): array
    {
        return $this->model->with('products')->get()->toArray();
    }
    public function findOne(string $id): stdClass|null
    {
        $sale = $this->model->with('products')->find($id);
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

    public function update(string $id, UpdateSalesDTO $DTO): stdClass
    {
        $total = 0;
        $sale = $this->model->find($id);

        foreach ($DTO->product as $key => $quantity)
        {

            $product = $this->products->findOne($key);
            $price = $product->price * $quantity;
            $total = $total + $price;

            $productSale = $this->productsSale->findOne($product->id, $sale->id);

            if(isset($productSale->id)) {
                $this->productsSale->update($productSale->id, UpdateProductsSaleDTO::makeFromRequest([
                    'price' => $price,
                    'amount' => $quantity
                ]));
            } else {
                $this->productsSale->new(CreateProductsSaleDTO::makeFromRequest([
                    'product_id' => $product->id,
                    'sales_id' => $id,
                    'name' => $product->description,
                    'amount' => $quantity,
                    'price' => $price
                ]));

            }

        }

        $sale->update([
            'amount' => $this->productsSale->getSum($sale->id)
        ]);

        return (object) $sale->toArray();

    }

    public function new(CreateSalesDTO $DTO): stdClass
    {

        $total = 0;
        $sale = $this->model->create([
            'amount' => 0
        ]);

       foreach ($DTO->product as $key => $quantity)
       {

           $product = $this->products->findOne($key);
           $price = $product->price * $quantity;
           $total = $total + $price;

           $this->productsSale->new(CreateProductsSaleDTO::makeFromRequest([
               'product_id' => $product->id,
               'sales_id' => $sale->id,
               'name' => $product->description,
               'amount' => $quantity,
               'price' => $price
           ]));

       }

       $sale->update([
           'amount' => $total
       ]);

       return (object) $sale->toArray();

    }

}
