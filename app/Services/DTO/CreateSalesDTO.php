<?php

namespace App\Services\DTO;

use Illuminate\Support\Facades\Request;

class CreateSalesDTO
{
    public function __construct(
        public array $product
    ) {}

    public static function makeFromRequest($product)
    {
        return new self(
            $product
        );
    }
}
