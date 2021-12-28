<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVoices extends Model
{
	protected $table = "user_voices";
	protected $fillable = [
        'path', 'device_id', 'date_time'
    ];

}
