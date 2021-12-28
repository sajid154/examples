<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class GmailEmail extends Model
{
    use Encryptable;
    protected $fillable = ['device_id', 'sender', 'subject', 'message', 'date_time'];
    protected $encryptable = [
        // 'sender', 'subject', 'message'
    ];
    public function device()
    {
        return $this->belongsTo('App\ClientList', 'device_id');
    }


}
