<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentDetails extends Model
{

    protected $table = 'agent_details';
    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id');
    }



}
