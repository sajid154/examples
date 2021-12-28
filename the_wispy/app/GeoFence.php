<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoFence extends Model
{
    protected $table = 'geo_fences';

    protected $fillable = [
        'device_id',
        'area_name',
        'latitude',
        'longitude',
        'radius',
    ];

    public function breach_logs()
    {
        return $this->hasMany('App\UserGeoFenceStatus', 'geo_fence_id');
    }

    

}
