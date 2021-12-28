<?php

namespace App\Http\Middleware;

use Closure;
use App\ClientList;
use Carbon\Carbon;
class CheckUniqueId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(request()->deviceID != null || request()->route()->parameter('device_id') || request()->device_id != null){

            if(request()->deviceID != null){
            
            $unique_id = request()->deviceID;
        
            } else if(request()->device_id != null){
            
            $unique_id = request()->device_id;
        
            }

            else if(request()->route()->parameter('device_id') != null){
            
            $unique_id = request()->route()->parameter('device_id');
            
            }
            
            $device= ClientList::where('uniqueid', $unique_id)->first();
// dd($device);
            if($device->device_end_date > Carbon::now()){
                    
                     return $next($request);

            }

            else{

              return response()->json([
                'issue'=> 'Your current plan is expired please subscribe again..',
                'code'=> 426]);
                }
            }


        else{
            return response()->json([
                'issue'=> 'Un-Authorized',
                'code'=> 401]);
        }

    }
}
