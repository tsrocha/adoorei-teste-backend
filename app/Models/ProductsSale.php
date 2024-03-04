<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsSale extends Model
{
    use HasFactory;

    protected $table = 'products_sale';
    protected     $guarded = [];
    protected     $hidden  = [];

}
