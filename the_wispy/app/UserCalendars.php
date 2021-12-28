<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class UserCalendars extends Model
{
	use Encryptable;
	protected $table = "user_calendars";
	
	protected $fillable = [
        'title', 'start_time', 'finish_time', 'event_location', 'device_id','description'
    ];
    protected $encryptable = [
        'title','event_location','description'
    ];

}
