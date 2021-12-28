<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGallery extends Model
{
	protected $table = "user_galleries";
	protected $fillable = [
        'path', 'device_id', 'date_time'
    ];

}
