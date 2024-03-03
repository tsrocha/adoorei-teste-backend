<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Services\ProductsService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct(
        protected ProductsService $service
    ) {}

    /**
     * List of products available
     */
    public function index(Request $request)
    {
        try
        {
            $products = $this->service->getAll($request->filter);
            return response()->json(['products' => $products]);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

}
