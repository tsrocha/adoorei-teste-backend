<?php

namespace App\Http\Controllers;

use App\Models\Products;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * List of products available
     */
    public function index(Request $request)
    {
        try
        {
            $products = Products::all();
            return response()->json(['products' => $products]);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

}
