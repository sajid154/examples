<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGeoFenceStatus extends Model
{
      protected $table = 'user_geo_fence_statuses';

    protected $fillable = [
        'device_id',
        'geo_fence_id',
        'in_time',
        'out_time',
        'duration',
       	'date'
    ];

    public function fence()
    {
        return $this->belongsTo('App\GeoFence', 'geo_fence_id');
    }
}
