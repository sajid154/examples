<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Traits\Encryptable;

class UserApplication extends Model
{
	// use Encryptable;
    protected $table = 'user_applications';

    protected $fillable = [
    	'device_id',
        'application_logo',
        'application_name',
        'application_package_name',
        'application_time_usage',
        'date_time'
    ];
     // protected $encryptable = [
     //     'application_logo',
     //     'application_name',
     //     'application_package_name',
     //     'application_time_usage'
     //     ];

}
