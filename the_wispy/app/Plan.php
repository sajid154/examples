<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plans';

    protected $fillable = [
        'title',
        'cost_price',
        'sale_price',
        'description',
        'status','month_id'
    ];

    public function features()
    {
        return $this->belongsToMany('App\Feature','plans_features','plans_id', 'feature_id');
        //return $this->belongsToMany('App\Feature')->withPivot('plans_features');

    }
	
    public function plan_duration(){
        return $this->belongsToMany('App\Month','month_plan');
    }
    public function month(){
        return $this->belongsTo('App\Month','month_id');
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }


    public function users()
    {
    return $this->belongsToMany('App\User', 'device_plans');
    }

}
