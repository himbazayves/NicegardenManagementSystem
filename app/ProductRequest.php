<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = ['description','reference', 'user_id', 'waiter_id','chef_id','stock_manager_id',
                          'accountant_id','resto_chef_id', 'house_keeper_id'];
    
    public function user() {
        return $this->belongsTo('App\User');
    }
    public function waiter() {
        return $this->belongsTo('App\Waiter');
    }
    public function chef() {
        return $this->belongsTo('App\Chef');
    }
    public function stockManager() {
        return $this->belongsTo('App\StockManager');
    }
    public function accountant() {
        return $this->belongsTo('App\Accountant');
    }
    public function restoChef() {
        return $this->belongsTo('App\RestoChef');
    }
    public function houseKeeper() {
        return $this->belongsTo('App\HouseKeeper');
    }


    public function requestedTo()
    {
        return $this->belongsTo('App\User', 'requested_to');
    }
}
