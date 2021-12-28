<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchedKeyword extends Model
{
    protected $table = "searched_keywords";
    protected $fillable = ['device_id', 'keyword', 'date_time'];


}
