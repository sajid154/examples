<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordVideo extends Model
{
	
	
	protected $table = "record_video";
	protected $fillable = [
        'path', 'device_id', 'date_time','slug'
    ];


}
