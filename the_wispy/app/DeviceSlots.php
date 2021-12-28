<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceSlots extends Model
{
	// public $timestamps = false;
    protected $table = "device_slots";
	protected $fillable = [
        'id','plan_id', 'device_id','device_id_d', 'user_id','payment_id', 'price','device_start_date','device_end_date','device_expiration_date'
    ];

}
