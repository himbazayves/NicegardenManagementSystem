<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockManager extends Model
{
    protected $fillable = ['names'];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
