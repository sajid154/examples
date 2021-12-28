<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class WifiLogger extends Model
{
	
	protected $table = "wifi_loggers";
	protected $fillable = [
        'name', 'date_time', 'location', 'device_id'
    ];

}
