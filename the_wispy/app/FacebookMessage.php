<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class FacebookMessage extends Model
{
    use Encryptable;
    
    protected $table = "facebook_messages";

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
