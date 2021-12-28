<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    //
     protected $fillable = [
        'months_description',
        'month_days',
        'cost_price','selling_price'

    ];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
