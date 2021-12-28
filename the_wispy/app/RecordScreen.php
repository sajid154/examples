<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordScreen extends Model
{
	
	
	protected $table = "record_screen";
	protected $fillable = [
        'path', 'device_id', 'date_time','slug'
    ];


}
