<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $table =  "messages";

    protected $guarded = [];

     public function agent(){
        return $this->belongsTo('App\User');
     }
}
