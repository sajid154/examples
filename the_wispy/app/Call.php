<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class Call extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'calllog';


     protected $fillable = [
        'number', 'device_id','type','duration','name','date_time'
    ];
}