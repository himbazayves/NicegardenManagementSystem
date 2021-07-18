<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestoChef extends Model
{
    protected $fillable = ['names'];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
