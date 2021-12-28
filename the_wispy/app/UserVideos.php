<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVideos extends Model
{
	protected $table = "user_videos";
	protected $fillable = [
        'path', 'device_id', 'date_time'
    ];

}
