<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class LocationDetail extends Model
{
	use Encryptable;
	protected $table = "user_location_details";
	protected $fillable = [
        'latitude','longitude','device_id','address','user_locations_id','date_time'
    ];
    protected $encryptable = [
        'latitude','longitude','address'
    ];
    // public function location_details()
    // {
    //     return $this->hasMany('App\LocationDetails');
    // }
}
