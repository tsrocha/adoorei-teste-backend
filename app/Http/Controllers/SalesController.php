<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Services\DTO\CreateSalesDTO;
use App\Services\SalesService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try
        {
            $sales = Sales::with('sale')->get();
            return response()->json(['sales' => $sales]);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->service->new(CreateSalesDTO::makeFromRequest($request));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try
        {
            $sales = $this->service->findOne($id);
            return response()->json($sales);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

}
