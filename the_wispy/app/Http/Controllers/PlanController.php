<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Closure;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use App\Payment;
use App\Feature;
use App\PlanFeatures;
use App\Plan;
use App\User;
class PlanController extends Controller
{
    public function index(Request $request)
	{
		if(Auth::user()->email === User::DEMO_EMAIL){
			return redirect('/register');
		}
		 if(\Auth::check()){
			
			// if(Auth::)
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
		$free_user_check = Payment::select('payment_id')->where('user_id', $session)->count();
		$assigned_features = PlanFeatures::with(['features'=> function($query){
				// $query->groupBy('feature_id');	
			}])->groupBy('feature_id')->groupBy('type')->get();

		$plans_group = Plan::where('status',1)->select(DB::raw('count(type) as count_plan, plans.*'))->groupBy('type')->get();
		$plans = Plan::where('status',1)->get();
		// dump($plans_group);
		// dd($plans);

		return view ('user.plan', compact('session','assigned_features','plans_group','plans','free_user_check'));	
		//}
		//return "Testing";
	}
    else{
        return redirect('/login');
    }
}
	public function show(Plan $plan, Request $request)
	{
	     return view('plans.show', compact('plan'));
	}
}
