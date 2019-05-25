<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "response";
    protected $fillable = [
        'review_id', 'admin_id', 'content'
    ];

    public function review()
    {
        return $this->belongsTo('App\Product_Review', 'review_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
