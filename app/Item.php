<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name', 'quantity', 'status',
    ];

    public function demand()
    {
        return $this->belongsTo('App\Demand');
    }
}
