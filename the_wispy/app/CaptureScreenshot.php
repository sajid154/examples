<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaptureScreenshot extends Model
{
	protected $table = "capture_screenshots";
	protected $fillable = [
        'path', 'device_id', 'date_time','slug'
    ];


}
