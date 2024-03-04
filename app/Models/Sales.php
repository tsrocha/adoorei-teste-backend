<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected     $table   = 'sales';
    protected     $guarded = [];
    protected     $hidden  = [];

    public function products()
    {
        return $this->hasMany(ProductsSale::class, 'sales_id', 'id');
    }

}
