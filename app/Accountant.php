<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountant extends Model
{
    //
    protected $fillable = ['names'];
    
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }
}
