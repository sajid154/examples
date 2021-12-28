<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordAudio extends Model
{
	
	
	protected $table = "record_audio";
	protected $fillable = [
        'path', 'device_id', 'date_time','slug'
    ];


}
