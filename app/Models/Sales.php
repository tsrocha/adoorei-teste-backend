<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public function sale()
    {
        return $this->hasOne(SalesHasProducts::class, 'sales_id','id')->with('products');
    }

}
