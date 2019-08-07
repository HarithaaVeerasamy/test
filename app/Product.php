<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        'product_name', 'product_brand', 'price','image','status'
    ];
}
