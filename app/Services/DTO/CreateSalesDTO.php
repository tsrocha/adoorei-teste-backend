<?php

namespace App\Services\DTO;

use Illuminate\Support\Facades\Request;

class CreateSalesDTO
{
    public function __construct(
        public array $products
    ) {}

    public static function makeFromRequest(Request $request)
    {
        return new self(
            $request->products
        );
    }
}
