<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    protected $fillable = ['names'];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
