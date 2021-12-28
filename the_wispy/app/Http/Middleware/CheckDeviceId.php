<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckDeviceId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next, $checkID=null)
    {

    // if ($request->path() === 'devices') {
    //     return $next($request);
    // }


    if(isset($checkID)){
          $id = $request->par;  
        }else
        $id = $request->id;

        $user_id = \App\ClientList::select('user_id as user')->where('id', $id)->where('device_status',"active")->first();

    if(Auth::user()->roles->first()->name == "SuperAdmin"){
                $id = $user_id->user;
        }else{
            $id =  Auth::id();
        }

        if(isset($user_id->user) && $user_id->user == $id){
            return $next($request);
        }else{
            return redirect('devices');
        }
    }
    
}
