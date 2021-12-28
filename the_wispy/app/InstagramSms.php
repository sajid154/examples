<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class InstagramSms extends Model
{
    use Encryptable;
    protected $table = "instagram_sms";
    protected $fillable = [
        'contact_name', 'device_id', 'message', 'status', 'time'
    ];
    protected $encryptable = [
        'contact_name', 'message', 'status'
    ];
    
    	
}
