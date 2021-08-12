<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedProduct extends Model
{
    protected $fillable = ['product_list_id','product_request_id', 'quantity'];

public function product_list() {
return $this->belongsTo('App\ProductList');
}

public function product_request() {
    return $this->belongsTo('App\ProductRequest');
    }
}
