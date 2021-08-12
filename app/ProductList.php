<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ProductList extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'name',  'product_category_id', 'price' , 'product_mesaurement_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id')->withTrashed();
    }


    public function measurement()
    {
        return $this->belongsTo('App\ProductMesaurement', 'product_mesaurement_id');
    }

    public function requested_products()
    {
        return $this->hasMany('App\RequestedProduct');
    }
}
