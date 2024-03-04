<?php

namespace Tests\Feature;

use App\Http\Controllers\ProductsController;
use App\Repositories\ProductsRepositoryInterface;
use App\Services\ProductsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductListTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $productServiceMock = $this->createMock(ProductsService::class);
        $productServiceMock->expects($this->once())
            ->method('getAll');

        $controller = new ProductsController($productServiceMock);
        $response = $controller->index();

        $response->getCallback();
    }
}
