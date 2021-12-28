<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class Location extends Model
{
	use Encryptable;
	protected $table = "user_locations";
	protected $fillable = [
        'latitude','longitude','device_id','address','date_time','status'
    ];
    protected $encryptable = [
        'latitude','longitude','address'
    ];
    public function location_details()
    {
        return $this->hasMany('App\LocationDetail','user_locations_id');
    }
}
