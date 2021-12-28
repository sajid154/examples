<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class ApiStatus extends Model
{
    // use Encryptable;
    protected $table = "api_status";
    protected $fillable = [
        'api_name', 'status','device_id'
    ];

}
