<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
// use App\Traits\Encryptable;

class CallRecordings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // use Encryptable;
	protected $table = "call_recordings";

	protected $fillable = [
        'number', 'device_id','type','duration','name','date_time','path','dummy'
    ];
	public function ClientList()
	{
		return $this->hasOne('App\ClientList','id');
	}
	  // protected $encryptable = [
   //      'name',
   //      'number',
   //      'type',
   //      'cont_name',
   //      'duration'
   //      ];
}