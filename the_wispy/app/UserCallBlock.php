<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCallBlock extends Model
{
		protected $table = "user_call_blocks";
		protected $fillable = ['device_id, phone_number'];

		public function device()
		{
		   return $this->belongsTo('App\ClientList');
		}


}
