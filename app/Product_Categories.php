<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Categories extends Model
{
    protected $table = "product_categories";
    protected $fillable = ['category_name'];

    public function roles()
    {
        return $this->belongsToMany('App\Product', 'product_category_details','product_id','category_id');
    }
}
