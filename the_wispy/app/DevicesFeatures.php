<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevicesFeatures extends Model
{
	// public $timestamps = false;
    protected $table = "devices_featured";
	protected $fillable = [
        'user_id', 'uniqueid','plan_id','features_id'
    ];
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function calllog()
	{
		return $this->belongsTo('\App\Calllog','device_id');
	}
	public function sms()
	{
		return $this->belongsTo('\App\SMS','device_id');
	}
	public function features()
	{
		return $this->belongsTo('\App\Feature');
	}
}
