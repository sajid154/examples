<?php

namespace App;
use App\Traits\Encryptable;

use Illuminate\Database\Eloquent\Model;

class ViberSms extends Model
{
    use Encryptable;
    protected $table = "viber_sms";
    protected $fillable = [
        'contact_name', 'device_id', 'message', 'status', 'time'
    ];
    protected $encryptable = [
        'contact_name', 'message', 'status'
    ];

    public function contact(){
        return $this->belongsTo('App\Contact');
    }
}
