<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'title', 'status', 'level',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
