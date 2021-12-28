<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingUserCallBlock extends Model
{
    protected $table = "incoming_user_call_blocks";
    protected $fillable = ['device_id', 'phone_number', 'date_time'];

    public function device()
    {
    	return $this->belongsTo('App\ClientList');
    }
}
