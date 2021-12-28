<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakePicture extends Model
{
	protected $table = "take_pictures";
	protected $fillable = [
        'path', 'device_id', 'date_time','slug'
    ];


}
