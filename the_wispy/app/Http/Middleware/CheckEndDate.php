<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;
class CheckEndDate
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

       $id = $request->id;
        if ($request->path() === 'dashboard/'.$id ) {
            return $next($request);
        }
         $client_data =\App\ClientList::join('plans','plans.id','clientlist.plan_id')
         ->select('device_end_date','plan_id')
         ->where('clientlist.id', $id)->first();

        $assigned_features = \App\PlanFeatures::with('features')
                    ->where('plans_id', $client_data->plan_id)
                    // ->whereNotIn('feature_id', $supperesed_features)
                    ->get();
        foreach ($assigned_features as $key => $value) {

if(url()->current() == url($value->features['slug'].'/'.$id) && $client_data->device_end_date > Carbon::now()){
                return $next($request);
            }
        }
            return redirect('dashboard/'.$id);
    }
}
