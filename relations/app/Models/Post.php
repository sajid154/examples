<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
     public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

        public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }


    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

}
