<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
	  public function roles()
    {
        return $this
            ->belongsToMany('App\Role')
            ->withTimestamps();
    }
    public function clientlist()
    {
        return $this->hasMany('App\ClientList');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','system_requirement','last_login_at','last_login_ip','country_state_city', 'ref_code', 'status'
    ];

    const DEMO_EMAIL = "demo@thewispy.com";

    //  protected $casts = [
    //     'is_admin' => 'boolean',
    // ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];
	public function authorizeRoles($roles)
{
  if ($this->hasAnyRole($roles)) {
    return true;
  }
  abort(401, 'This action is unauthorized.');
}
public function hasAnyRole($roles)
{
  if (is_array($roles)) {
    foreach ($roles as $role) {
      if ($this->hasRole($role)) {
        return true;
      }
    }
  } else {
    if ($this->hasRole($roles)) {
      return true;
    }
  }
  return false;
}
public function hasRole($role)
{
  if ($this->roles()->where('name', $role)->first()) {
    return true;
  }
  return false;
}
public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Admin')
            {
                return true;
            }

        }

        return false;
    }


public function isAgent()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Agent')
            {
                return true;
            }

        }

        return false;
    }

public function isDigitaMarketing()     
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'Digital Marketing')
            {
                return true;
            }

        }

        return false;
    }

	public function isSuperAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->name == 'SuperAdmin')
            {
                return true;
            }

        }

        return false;
    }
  	public function getRole()
    {
      foreach ($this->roles()->get() as $role)
        if ($role->pivot->user_id == "")
        {
          return $role;
        }
        else
      return $role->name;
  	}

  	/**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    /**
    * Get the user's full name.
    *
    * @return string
    */
    public function getFullNameAttribute()
    {
      return "{$this->name} {$this->email}";
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function payments()
    {
        return $this->hasMany('App\Payment')->latest();
    }


    public function plans()
    {
     return $this->belongsToMany('App\Plan', 'device_plans');
    }

    public function agent_details()
    {
        return $this->hasOne('App\AgentDetails', 'agent_id');
    }

    public function commisions()
    {
        return $this->hasMany('App\AgentCommision', 'agent_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'agent_id');
    }


}