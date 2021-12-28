<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class SMS extends Model
{
    use Encryptable;
    protected $table = "smses";
    protected $fillable = [
        'number', 'type', 'date_time', 'name','status','message','device_id'
    ];
    protected $encryptable = [
        'name','message','number','type','contact_name'
    ];
    public function calllog()
{
    return $this->hasOne('\App\ClientList','id');
}

    public function contact(){
        return $this->belongsTo('App\Contact');
    }
    
}
