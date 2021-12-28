<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDataStatus extends Model
{
	protected $table = "client_data_statuses";
    protected $fillable = ['device_id', 'call_logs', 'sms', 'photos', 'videos', 'contacts', 'voices', 'calendars', 'installed_applications'];

    public function device()
    {
    	return $this->belongsTo('App\ClientList', 'device_id');
    }

}
