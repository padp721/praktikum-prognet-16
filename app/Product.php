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

    public function product_images(){
        return $this->hasMany('App\Product_Image');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function transaction()
    {
        return $this->belongsToMany('App\Transaction', 'transaction_details', 'product_id', 'transaction_id');
    }
}
