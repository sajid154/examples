<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class CallLog extends Model
{
	use Encryptable;
	protected $table = "calllog";

	protected $fillable = [
        'number', 'device_id','type','duration','name','date_time'
    ];
	public function ClientList()
	{
		return $this->hasOne('App\ClientList','id');
	}
	  protected $encryptable = [
        'name',
        'number',
        'type',
        'cont_name',
        'duration'
        ];

}
