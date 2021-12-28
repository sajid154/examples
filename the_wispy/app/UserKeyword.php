<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserKeyword extends Model
{
    protected $table = "user_keywords";

    protected $fillable = ['device_id', 'keyword'];

}
