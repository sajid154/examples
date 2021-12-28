<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
   //protected $table = 'features';
	 protected $fillable = [
        'feature_name',
        'feature_description',
        'slug',
        'icon'
    ];

    public function plans()
    {
        return $this->belongsToMany('App\Plan');
    }

    public function device_features()
    {
        return $this->hasMany('App\DevicesFeatures','features_id');
        //return $this->belongsToMany('App\Feature')->withPivot('plans_features');

    }
    public function plan_features()
    {
        return $this->hasMany('App\PlanFeatures','feature_id');
        //return $this->belongsToMany('App\Feature')->withPivot('plans_features');

    }
}
