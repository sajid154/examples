<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


class UserEmails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_emails';


     protected $fillable = [
        'email', 'template','user_id'
    ];
}