<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use Encryptable;
    protected $table = 'contacts';


     protected $fillable = [
        'name', 'number', 'device_id'
    ];
        protected $encryptable = [
        'name', 'number'
        ];
}