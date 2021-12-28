<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrowserHistory extends Model
{
    protected $table = "browser_histories";
    protected $fillable = [
        'device_id', 'browser_name', 'url_name', 'date_time'
    ];

    public function device()
    {
        return $this->belongsTo('App\ClientList', 'device_id');
    }

}
