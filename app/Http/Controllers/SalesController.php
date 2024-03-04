<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Services\DTO\CreateSalesDTO;
use App\Services\DTO\UpdateSalesDTO;
use App\Services\SalesService;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct(
        protected SalesService $service
    ) {}

    /**
     * Display a listing of the sales.
     */
    public function index()
    {
        try
        {
            $sales = $this->service->getAll();
            return response()->json($sales);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * Store a newly created sale in storage.
     */
    public function store(Request $request)
    {
        try {
            $sale = $this->service->new(CreateSalesDTO::makeFromRequest($request->product));
            return response()->json(['sale' => $sale]);
        } catch (RequestException $exception) {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

    /**
     * Update a newly created sale in storage.
     */
    public function update($id, Request $request)
    {
        try {
            $sale = $this->service->update($id, UpdateSalesDTO::makeFromRequest($request->product));
            return response()->json(['sale' => $sale]);
        } catch (RequestException $exception) {
            return response()->json(['msg' => $exception->getMessage()], 200);
        }
    }

    /**
     * Display the specified sale.
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

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * Delete/cancel specified sale
     */
    public function delete($id)
    {
        try
        {
            $sale = $this->service->delete($id);
            return response()->json(['msg' => 'success']);
        }
        catch (RequestException $exception)
        {
            return response()->json(['msg' => $exception->getMessage()], $exception->getCode());
        }
    }

}
