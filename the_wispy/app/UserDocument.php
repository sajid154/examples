<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
     protected $table = 'user_documents';

    protected $fillable = [
    	'user_document',
        'modified_date',
    ];
}
