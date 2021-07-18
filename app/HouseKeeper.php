<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseKeeper extends Model
{
    protected $fillable = ['names'];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
