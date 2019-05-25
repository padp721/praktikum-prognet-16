<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'timeout','address','regency','province','total','shipping_cost','sub_total','user_id','courier_id','proof_of_payment','status'
    ];

    public function courier()
    {
        return $this->belongsTo('App\Courier');
    }
    
    public function products()
    {
        return $this->belongsToMany('App\Product', 'transaction_details', 'transaction_id', 'product_id')->withPivot('qty','discount','selling_price');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
