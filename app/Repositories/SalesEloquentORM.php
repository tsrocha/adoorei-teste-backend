<?php

namespace App\Repositories;
use App\Models\Products;
use App\Models\ProductsSale;
use App\Models\Sales;
use App\Services\DTO\UpdateSalesDTO;
use stdClass;
use App\Services\DTO\CreateSalesDTO;

class SalesEloquentORM implements SalesRepositotyInterface
{
    public function __construct(
        protected Sales $model,
        protected Products $products,
        protected ProductsSale $productsSale
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

            $product = $this->products->find($key);
            $price = $product->price * $quantity;
            $total = $total + $price;

            $productSale = $this->productsSale->where('product_id', '=', $product->id)
                ->where('sales_id', '=', $sale->id)
                ->first();

            if(isset($productSale->id)) {
                $productSale->update([
                    'amount' => $quantity,
                    'price' => $price
                ]);
            } else {
                $this->productsSale->create([
                    'product_id' => $product->id,
                    'sales_id' => $id,
                    'name' => $product->description,
                    'amount' => $quantity,
                    'price' => $price
                ]);
            }

        }

        $totalSales = ProductsSale::where('sales_id', '=', $sale->id)->sum('price');

        $sale->update([
            'amount' => $totalSales
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

           $product = $this->products->find($key);
           $price = $product->price * $quantity;
           $total = $total + $price;

           $this->productsSale->create([
               'product_id' => $product->id,
               'sales_id' => $sale->id,
               'name' => $product->description,
               'amount' => $quantity,
               'price' => $price
           ]);

       }

       $sale->update([
           'amount' => $total
       ]);

       return (object) $sale->toArray();

    }

}
