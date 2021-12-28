<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentCommision extends Model
{
    protected $table = "agent_commisions";

    protected $guarded = [];


    public function agent()
        {
            return $this->belongsTo('App\User', 'agent_id');
        }    

}
