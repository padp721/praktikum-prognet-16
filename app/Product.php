<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'price', 'description','product_rate','stock','weight'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Product_Categories', 'product_category_details','product_id','category_id');
    }
}
