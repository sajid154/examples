<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceDetail extends Model
{
     protected $table = 'device_details';

    protected $fillable = [
        'number',
        'IMEI',
        'manufacturer',
        'modal',
        'device_id',
        'battery_level',
        'device_status',
        'network_carrier',
        'current_wifi',
        'current_location',
        'isAccessibilityServiceOn'
    ];
}
