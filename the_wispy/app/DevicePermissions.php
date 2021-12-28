<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class DevicePermissions extends Model
{
	// use Encryptable;
	protected $table = "device_permissions";
	protected $fillable = [
        'name', 'status','device_id'
    ];
    // protected $encryptable = [
    //     'name','message','number'
    // ];
    public function calllog()
{
    return $this->hasOne('\App\ClientList','id');
}
}
