<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommandTemp extends Model
{
	use SoftDeletes;

	protected $table = "command_temp_table";
	protected $fillable = [
        'path', 'device_id', 'date_time'
    ];

}
