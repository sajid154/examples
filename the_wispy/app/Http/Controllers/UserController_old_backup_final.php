<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use DB;
use Session;
use Image;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;
use App\Payment;
use App\SMS;
use App\User;
use App\UserVoices;
use App\DevicesFeatures;
use App\CallLog;
use App\ClientList;
use App\Feature;
use App\Location;
use Carbon\Carbon;
use App\PlanFeatures;
use App\Plan;
use Validator;
use Hash;

class UserController extends Controller
{
    //
	 public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:User')->except('index','show');
		if(Session::has("basket")){
        session_start();
		$_SESSION['basket_size'] = Auth::name();
    }
	}
	public function index(Request $request)
	{
		// dd(Auth::user()->roles->first()->name == "SuperAdmin");
		if(Auth::user()->roles->first()->name == "SuperAdmin"){
				// dd($request->all());
				$id = Session::get('device_id');
				// dd($id);
		}else{
			$id =  Auth::id();
		}
		$paiduser = DB::table('payments')->where('user_id', $id)->get();
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

			$assigned_features = PlanFeatures::with(['features'=> function($query){
				// $query->groupBy('feature_id');	
			}])->groupBy('feature_id')->groupBy('type')->get();

		$plans_group = Plan::where('status',1)->select(DB::raw('count(type) as count_plan, plans.*'))->groupBy('type')->get();
		$plans = Plan::where('status',1)->get();
	
	$free_user_check = Payment::select('payment_id')->where('user_id', $session)->count();
		//$session = session()->all();
		//dd($session);
	$device_id = ClientList::where('user_id',$id)->where('device_status','active')->first();
	
	if($device_id != null){
		if($free_user_check == 1){
				return	$this->show($request, $device_id->id);
		}
	}
		if ($paiduser->isNotEmpty()){
		$clientlist = DB::table('clientlist')->where('user_id', $id)
		->orderBY('id','desc')
		->get();
		$clientlist_plan = DB::table('clientlist')->where('user_id', $id)->select('uniqueid as key')->first();
		return view ('user.home',compact('clientlist','session','clientlist_plan'));	
		}
		return view ('user.plan',compact('session','assigned_features','plans_group','plans','free_user_check'));
	}

			public function check_inactive_devices(Request $request, $inactive_device_id=null)
	{
		// dd($request->all());
		

		// dd(Auth::user()->roles->first()->name == "SuperAdmin");
		if(Auth::user()->roles->first()->name == "SuperAdmin"){
				// dd($request->all());
				$id = Session::get('device_id');
				// dd($id);
		}else{
			$id =  Auth::id();
		}
		$paiduser = DB::table('payments')->where('user_id', $id)->get();
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');


		//dd($session);
		if ($paiduser->isNotEmpty()){

		$clientlist = ClientList::
		where('id', $inactive_device_id)
		->first();
		
		return view ('user.check_inactive_devices',compact('clientlist','session'));	
		}
	
	}
	

	public function get_parent($id){

$array = array();
		$exist = ClientList::where('id',$id)->select('parent_id','id')->first();
		 
// return $exist;
		// dump($exist) ;
		if(!empty($exist)){
			
			 $data = ClientList::where('parent_id' ,$exist['parent_id'])->first();
			 $array['parent_id'][] = $exist['parent_id'];
			return	$this->get_parent($data['parent_id']);
		}
		else{
			$array = "As";
		}

		return $array;

	}


	public function show(Request $request, $id)
    {

		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$request->session()->flash('unique_id', $clientlist->uniqueid);
		$session_uniqueid = session()->get('unique_id');
		$session = session()->get('device');

		// return $id;
		// $res = $this->get_parent($id);
		// dd($res);


	// $client_data = 	ClientList::Join('plans','plans.id','clientlist.plan_id')->select('clientlist.*','plans.title')->whereRaw("clientlist.uniqueid = 'iNOphntuGPDtHnIcua0X7r2pn1UVJJ'")->get();

// DB::enableQueryLog();
	$client_data = 	DB::table('clientlist')->select('clientlist.*','plans.title')
        ->join('plans', function ($join) use($session){
            $join->on('plans.id', '=', 'clientlist.plan_id')
                 ->whereRaw("clientlist.uniqueid IN (SELECT clientlist.uniqueid FROM clientlist where clientlist.id = $session)");
        })
        ->orderBY('id','desc')->get();

   	$client_data = ClientList::with(['clientlist_plans.plans' => function($query) {
       return $query->select(['id','title','type']);
},'clientlist_plans' => function($query) {
    return $query->orderBY('id','desc')->where('plan_status',1);
}])
   	->where('clientlist.id', '=' ,$session)
   	->orderBY('clientlist.id','desc')
   	->first();
	
		$sms_test = SMS::select('smses.message','smses.number','smses.name','smses.id','smses.date_time')
        ->where('smses.device_id', $clientlist->id)


        // ->groupBy('smses.number')
        ->orderBy('smses.id','desc')
        ->first();

           // dd($sms_test);

           
        $recent_call =  CallLog::
        select('calllog.date_time','calllog.duration','calllog.type','name')
        ->where('calllog.device_id', $clientlist->id)
        // ->groupBy('smses.number')
        ->orderBy('calllog.id','desc')
        ->first();
        
		$recent_location = Location::where('device_id', $clientlist->id)->latest()->first();
// 
        // dd($recent_location);
// dd(DB::getQueryLog());
	// dd(array_first($client_data));
		// $plan_id = ClientList::select('plan_id','plan_id as plan','uniqueid')->where('id', $session)->first();
// return $plan_id->plan_id;
		// $plans = DB::table('plans_features')->where('plans_id', $client_data->plan_id)->get();
	 //    if(!empty($plans)){

	 //    	DevicesFeatures::where('uniqueid',$id)->delete();

	 //        foreach ($plans as $plan) 
	 //        {
		// 	DevicesFeatures::create([ 
		// 			'user_id' => Auth::user()->id,
		//             'uniqueid'=> $id,
		//             'plan_id' => $client_data->plan_id,
		//             'features_id' => $plan->feature_id
		// 		]);
	 //        }
	 //    }
	    // echo "$id";
	    // $supperesed_features = DevicesFeatures::where('uniqueid',$id)->select('features_id')->get();
    	// $features = PlanFeatures::with('features')
    	// ->where('plans_id', $client_data->plan_id)
    	// ->whereNotIn('feature_id', $supperesed_features)
    	// ->get();
	    // dd($assigned_features);
    	//  // foreach($assigned_features as $assigned_feature){
     //  //                       dd($assigned_feature->features['feature_name']);exit(); 

    	//  // }

		$get_graph_data =  get_graph_data($request, $id);
		// dd($get_graph_data);
		return view ('user.dashboard',compact('client_data','id','sms_test','clientlist','recent_call','recent_location','get_graph_data'));
		
	
	}
	public function plans($id){
		// return $id;
	if(\Auth::check()){
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

		$assigned_features = PlanFeatures::with(['features'=> function($query){
				// $query->groupBy('feature_id');	
			}])->groupBy('feature_id')->groupBy('type')->get();


		$current_plan =  ClientList::select('plan_id')->where('id',$id)->where('subscribed',1)->first();
		$free_user_check = Payment::select('payment_id')->where('user_id', $session)->count();
		$plans_group = Plan::where('status',1)->select(DB::raw('count(type) as count_plan, plans.*'))->groupBy('type')->get();
		$plans = Plan::where('status',1)->get();
		// dd($plans);
		// dd($plans_group);
		return view ('user.plan', compact('session','plans','plans_group','assigned_features','id','current_plan','free_user_check'));	
		//}
		//return "Testing";
	}
    else{
        return redirect('/login');
    }

	}
	public function edit(Request $request, $id)
    {
		$clientlist = \App\User::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session_device = session()->get('device');
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
		$client_data = 	DB::table('clientlist')->select('clientlist.*','plans.title')
        ->join('plans', function ($join) use($session_device){
            $join->on('plans.id', '=', 'clientlist.plan_id')
                 ->whereRaw("clientlist.uniqueid IN (SELECT clientlist.uniqueid FROM clientlist where clientlist.id = $session_device)");
        })
        ->orderBY('id','desc')->get();
		return view ('user.edit',compact('clientlist','session','client_data'));
	}

	public function update(Request $request)
    {
   	
   	$messages = [
		    'current-password.required' => 'Please enter current password',
		    'password.required' => 'Please enter password',
		  ];

		  $validator = Validator::make($request->all(), [
		    'current-password' => 'required',
		    'password' => 'required|same:password',
		    'password_confirmation' => 'required|same:password',     
		  ], $messages);

		   if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


  if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

                $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->system_requirement = $request->password;
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

        
        /*code update user name and email*/

        //Change Password
  //       $user = Auth::user();
  //       $user->password = bcrypt($request->get('new-password'));
  //       $user->system_requirement = $request->password;
  //       $user->save();

  //       return redirect()->back()->with("success","Password changed successfully !");


  //       		$clientlist = \App\User::find($request->id);
		// // $validator = $this->validate($request, [
	 // 	//'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
	 // 	//]);
		// if(!empty($request->avatar)){
		// 	$filename = Auth::id().'_'.time().'.'.$request->avatar->getClientOriginalExtension();
  //  			$request->avatar->move(public_path('uploads/avatars'), $filename);
			
		// }
		// else{
		// 	$filename = $clientlist->avatar;
		// }
 
		// $clientlist->avatar = $filename;
		// $clientlist->name = $request->name;
		// $clientlist->email = $request->email;
		// $clientlist->update();

				
		// return redirect('/account/'.$clientlist->id.'/edit')->with('success', 'Profile Updated');



	}
	public function calls(Request $request, $id)
	{	
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			//$clientlist = \App\ClientList::find($id);	
			$clientlists = DB::table('calllog')->where('device_id', $session)->get();
			return view ('user.calls',compact('clientlists','session'));
			//dd();
		}
	public function smses(Request $request, $id)
	{
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = SMS::where('device_id', $session)->groupBy('number')->get();
			return view ('user.smses',compact('clientlists','session'));
	}
	public function contacts(Request $request, $id)
	{
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = DB::table('contacts')->where('device_id', $session)->get();
			//dd($clientlists);
			return view ('user.contacts',compact('clientlists','session'));
	}
	public function photos(Request $request, $id)
	{		
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = UserVoices::where('device_id', $session)->get();
			return view ('user.photos',compact('clientlists','session'));
	}
	public function videos(Request $request, $id)
	{		
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = DB::table('user_videos')->where('device_id', $session)->get();
			return view ('user.videos',compact('clientlists','session'));
	}
	public function recording(Request $request, $id)
	{		
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = DB::table('user_voices')->where('device_id', $session)->get();
			return view ('user.recording',compact('clientlists','session'));
	}

	public function checkout(Request $request)
	{
		$id = $request->plan_id;
		$client_id = $request->client_id;
		$oldkey = $request->oldkey;
		if($id){
		Session::put('plan_id_sess', $id);
		Session::put('client_id', $client_id);
		Session::put('old_key', $oldkey);
			}
			else{
					$id = session::get('plan_id_sess');
					$client_id =session::get('client_id');
					$old_key =session::get('old_key');
			}
		$clientlist = DB::table('clientlist')->where('user_id', Auth::id())->get();
		$user = DB::table('users')->where('id', Auth::id())->first();
		if($user->email_verified_at != null){Mail::to($user->email)->send(new VerifyMail($user));}
		//Mail::to($user->email)->send(new VerifyMail($user));
		$pkginfo = DB::select("select * from plans where id='$id'");
		return view ('user.checkout',compact('clientlist','pkginfo','client_id','user','oldkey'));
	}
	 public function update_avatar(Request $request){
 
    
    $user->save();
}
public function verifyUser($token){
        $verifyUser = User::where('token',$token)->first();
        if(isset($verifyUser) ){
            if(!$verifyUser->email_verified_at){
                $verifyUser->email_verified_at = Carbon::now();
                $verifyUser->save();
                $status = "Your e-mail is verified. You can now login.";
            }
            else{
                $status = "Your Email is already Verified";
            }
        }
        else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('status', $status);

    }
    public function SendVerifyEmail(){
	     return view('auth.verify');
    }
	public function setup_wizard_one($id){
	     $session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
	return view('user.setup_wizard_one',compact('session','id'));
    }
	public function setup_wizard_three($id){
	$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
	return view('user.setup_wizard_three',compact('session','id'));
}
	public function setup_wizard_two($id=null){
	
		$clientlist = ClientList::where('id', $id)->first();
		$session = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
		return view('user.setup_wizard_two',compact('clientlist','session','id'));
}
}