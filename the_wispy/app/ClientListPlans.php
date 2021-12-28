<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientListPlans extends Model
{
	// public $timestamps = false;
    protected $table = "device_plans";
	protected $fillable = [
         'clientlist_id','plan_id','user_id','uniqueid','plan_status','payment_id'
    ];
	public function clientlist()
	{
		return $this->belongsTo('App\ClientList');
	}

	public function plans(){
		return $this->belongsTo('App\Plan','plan_id');
	}
}
