<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebHistory extends Model
{
     protected $table = 'web_histories';

	    protected $fillable = [
	    	'url',
	        'title',
	        'device_id',
	        'last_vist_time',
	        'bookmark',
	    ];
}
