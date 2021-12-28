<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFeatures extends Model
{
	// public $timestamps = false;
    protected $table = "plans_features";
	protected $fillable = [
        'feature_id','plan_id','type'
    ];

    public function features()
	{
		return $this->belongsTo('App\Feature','feature_id');
	}
	
}
