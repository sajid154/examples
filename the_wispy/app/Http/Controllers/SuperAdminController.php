<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\User;
use App\Plan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use App\ClientList;

class SuperAdminController extends Controller
{
	    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:SuperAdmin');
    }
    public function index()
    {
  	
        return view('superadmin.home');
    }
	public function addNewUser()
    {
		return view ('superadmin.add-new');
	}
	public function users()
	{
		$users = \App\User::all();
		return view('superadmin.users',compact('users'));
	}
	public function show($id)
    {
		$singlesuer = \App\User::find($id);
		return view ('superadmin.show',compact('singlesuer'));
    }
	public function edit($id)
    {
        //
		$singlesuer = \App\User::find($id);
		return view ('superadmin.edit',compact('singlesuer'));
    }
	    public function update(Request $request, $id)
    {
		$user= \App\User::find($request->id);
		$user->name= $request->name;
		$user->email= $request->email;
		$user->role_id= $user->roles()->sync($request->role_id);
		return redirect('/superadmin/users/'.$user->id)->with('success', 'User Updated!');
    }
	public function deleteUSer($id)
    {
		$user = \App\User::find($id); $deleted = $user->delete();
		return redirect('/superadmin/users/')->with('success', 'User Deleted!');
    }
	public function store(Request $request)
    {	
		$user= \App\User::create([
		'name' => $request->name,
		'email'=> $request->email,
		'password'=> Hash::make('password')
	]);
	}

	public function displayalluserdevices(Request $request)
	{
	
		$clientlist = DB::table('clientlist')->where('user_id', $request->user_id)->get();
			return view ('devices.home',compact('clientlist'));
	}
	//////////////////////
	public function showplans()
	{
		$plans = \App\Plan::all();
		return view ('superadmin.plans.showplans',compact('plans'));
	}
	public function addplan()
	{
		$months = \App\Month::all();
		return view ('superadmin.plans.add-newplan',compact('months'));
	}
	public function storeplan(Request $request)
	{
		//return view('superadmin.months.addmonth');
		$validatedData = $request->validate([
        'title' => 'required|unique:plans|max:255',
        'cost_price' => 'required|numeric|min:1',
        'sale_price' => 'required|numeric|min:1',
		'status' => 'required',
		'month' => 'required',
    	]);
		
		$plans= \App\Plan::create([
			'title'=>$request->title,
			'cost_price' => $request->cost_price,
			'type' => $request->type,
			'sale_price' => $request->sale_price,
			'status' => $request->status,
			'month_id' => $request->month,
		]);
		return redirect('plansmanagement')->with('success', 'Plan added');
	}

	public function viewplan($id)
	{
		$plan = \App\Plan::find($id);
		$months = \App\Month::all();
		return view('superadmin.plans.edit',compact('plan','months'));
	}

	public function editplan(Request $request)
	{
		 $request->validate([
            	'title'   =>  [
                'required',
                'max:255',
                Rule::unique('plans')->ignore($request->plan_id),
            ],
            'cost_price' => 'required|numeric|min:1',
        	'sale_price' => 'required|numeric|min:1',
        ]);

		$plans= \App\Plan::find($request->plan_id);
		$plans->title= $request->title;
		$plans->type= $request->type;
		$plans->cost_price= $request->cost_price;
		$plans->sale_price= $request->sale_price;
		$plans->status= $request->status;
		$plans->month_id=$request->month;
		$plans->save();

		return redirect('plansmanagement')->with('success', 'Plans updated');
	}
	///////////////////////////////////////////////////
	//month management
	public function showmonths()
	{
		$months = \App\Month::paginate(15);
		        //$data = User::paginate(10);

		return view ('superadmin.months.showmonths',compact('months'));
	}
	public function addmonth()
	{
		return view('superadmin.months.addmonth');
	}
	public function storemonth(Request $request)
	{

		//return view('superadmin.months.addmonth');
		$validatedData = $request->validate([
        'months_description' => 'required|unique:months|max:255',
        'month_days' => 'required|integer|min:1|max:365',
    	]);
  

			


		$months= \App\Month::create([
			'months_description' => $request->months_description,
			'month_days'=> $request->month_days,
			'cost_price'=> 1,
			'selling_price'=>1
		]);
		return redirect('monthsmanagement')->with('success', 'Month Added');
	}

	public function editmonth($id)
	{
		$month = \App\Month::find($id);
		return view('superadmin.months.edit',compact('month'));
	}
	public function editstoremonth(Request $request)
	{
    	$request->validate([
            	'months_description'   =>  [
                'required',
                'max:255',
                 Rule::unique('months')->ignore($request->month_id),
            ],
            'month_days' => 'required|integer|min:1|max:365',
        ]);

		$months= \App\Month::find($request->month_id);
		$months->months_description= $request->months_description;
		$months->month_days= $request->month_days;
		$months->save();
		return redirect('monthsmanagement')->with('success', 'Month updated');
	}

	//features
	public function showfeaturelist()
	{
		$features = \App\Feature::all();
		return view('superadmin.features.showfeature',compact('features'));
	}

	//features
	public function editfeature($id)
	{
		$singlefeature = \App\Feature::find($id);
		return view ('superadmin.features.edit',compact('singlefeature'));
	}

	public function addfeature()
	{


		return view ('superadmin.features.addfeature');
	}
	public function addnewfeature(Request $request)
	{
		$validatedData = $request->validate([
        'feature_name' => 'required|unique:features|max:255',
        'feature_description' => 'required|string',
    	]);

		$Feature= \App\Feature::create([
			'feature_name' => $request->feature_name,
			'feature_description'=> $request->feature_description,
			'slug'=> $request->slug,
			'icon'=> $request->icon
		]);
		return redirect('showfeaturelist')->with('success', 'Feature Added');
	}


	public function updatefeature(Request $request)
    {

    		$request->validate([
            	'feature_name'   =>  [
                'required',
                'max:255',
                 Rule::unique('features')->ignore($request->feature_id),
            ],
            'feature_description' => 'required|string',
        ]);

		$features= \App\Feature::find($request->feature_id);
		$features->feature_name= $request->feature_name;
		$features->feature_description= $request->feature_description;
		$features->slug= $request->slug;
		$features->icon= $request->icon;
		$features->save();
		return redirect('showfeaturelist'.$request->id)->with('success', 'Feature Updated!');
    }
    //////////////////////////

    public function planfeaturelist()
    {
    	 $users = DB::select('select * from student');
    }

    public function addplanfeature()
    {
    	$features= \App\Feature::all();
    	$plans= \App\Plan::all();
    	
    	return view ('superadmin.feature-plan.add',compact('features','plans'));
		// $features= \App\Feature::find($request->feature_id);
		// $features->feature_name= $request->feature_name;
		// $features->feature_description= $request->feature_description;
		// $features->save();
		//return redirect('showfeaturelist'.$request->id)->with('success', 'Feature Updated!');
    }

	/**
	* save plans
	*@param plans,features
	*@return success message on save plans
	* @return \Illuminate\Contracts\Support\Renderable
	*/
    public function savefutureplan(Request $request)
    {
  		$plan=$request->plans;
  		$features=$request->features;
  	
  		foreach($features as $val):
  			DB::table('plans_features')->insert([['plans_id' => $plan,'feature_id' => $val]]);
  		endforeach;
  		return "record inserted";
  		return redirect('/superadmin/listplanfuture/'.$request->id)->with('success', 'Record Added');
    }


    public function listplanfuture()
    {

    	$planfeatures= \App\Plan::with('features')->get();
    	foreach($planfeatures as $val1)
    	{
    		echo $val1->title."<br/>";

    		foreach($val1->features as $value2)
    		{
    			echo "<li>".$value2->feature_name."</li>";
    		}
    	}
    
    	// foreach($planfeatures[0]->features as $val1)
    	// {
    	// 	echo $val1->feature_name."<br/>";
    	// }
    	//dd($planfeatures[0]->cost_price);
    	// foreach ($planfeatures as $value) {
    
    	// }

    	die("testing");


    	$query1 = DB::select("select  DISTINCT(plans_features.plans_id),plans.title from  plans_features INNER join plans on plans_features.plans_id=plans.id");

    	$query2 = DB::select("select  plans_features.plans_id,plans_features.feature_id,features.feature_name from  plans_features INNER join features on plans_features.plans_id=features.id");
    	$full_res=array();
    	foreach($query1 as $val1)
    	{
    		print_r($val1->plans_id);
    		print_r($val1->title);
    		foreach($query2 as $val2)
    		{
    			//print($val);
    		}
    	}

    	die("tesing");


    	return view ('superadmin.feature-plan.index',compact('planfeatures'));

    }

    public function editplanfuture($id)
    {
    	$features= \App\Feature::all();
    	$plans= \App\Plan::find($id);
    	$plan=new Plan;
    	$task = \App\Plan::with('features')->toSql(); 
    	//get the first record
    	$query = User::select("*")->toSql();


    	$plans_features=DB::select("select * from plans_features where id=''");
    	$query1=DB::select("select * from plans_features where plans_id='$id'");
    	$featureslt=array();
    	foreach($query1 as $val)
    	{
    		$featureslt[]=$val->feature_id;
    	}
    	
    	return view ('superadmin.feature-plan.edit',compact('features','plans',
    		'plans_features','featureslt'));
    }

    public function editplanfeatures(Request $request)
    {
    	$plan_id=$request->plan_id;
    	$type=$request->type;
    	$querycount=DB::select("select * from plans_features where plans_id='$plan_id'");
    	if(count($querycount)>0)
    	{
    		 DB::delete("delete from plans_features where plans_id ='$plan_id'");
			foreach($request->features as $val)
			{
			 	DB::table('plans_features')->insert([['plans_id' => $plan_id,'type' => $type,'feature_id' => $val]]);
			}
    	}
    	else
    	{
    		foreach($request->features as $val)
			{
			 	DB::table('plans_features')->insert([['plans_id' => $plan_id,'type' => $type,'feature_id' => $val]]);
			}
    	}
    	return redirect('plansmanagement')->with('success', 'Plans Updated');
    }

	// public function updatefeature(Request $request, $id)
	//{
	// 	$features= \App\Feature::find($request->id);
	// 	$features->feature_name= $request->feature_name;
	// 	$features->feature_description= $request->feature_description;		
	// 	return redirect('/superadmin/showfeaturelist/'.$request->id)->with('success', 'Feature Updated!');
	//    }

			public function get_user_devices($id){
			// return $id;
		$result = ClientList::with('plans','payments')->where('user_id', $id)->orderBY('id','desc')->get();
		return view('superadmin.reports.show_devices', compact('result'));
			// dd($result);
	}
	public function user_device_stats($id){
			// return $id;
		DB::enableQueryLog();

		$result = 
		DB::select('SELECT  (
        SELECT COUNT(*)
        FROM   calllog where device_id =  '.$id.'
        ) AS calllog,
        (
        SELECT COUNT(*)
        FROM   capture_screenshots where device_id =  '.$id.'
        ) AS capture_screenshots,
         (
        SELECT COUNT(*)
        FROM   `contacts`    where device_id = '.$id.'
        ) AS contacts,
        (
        SELECT COUNT(*)
        FROM   `record_audio`  where device_id = '.$id.' 
        ) AS record_audio,
        (
        SELECT COUNT(*)
        FROM   `record_screen`   where device_id = '.$id.'
        ) AS record_screen,
        (
        SELECT COUNT(*)
        FROM   `record_video`  where device_id  = '.$id.' 
        ) AS record_video,
		(
        SELECT COUNT(*)
        FROM   `smses`   where device_id  = '.$id.'
        ) AS smses,
        (
        SELECT COUNT(*)
        FROM   `take_pictures`  where device_id  = '.$id.'
        ) AS take_pictures,
        (
        SELECT COUNT(*)
        FROM   `user_applications`  where device_id  = '.$id.'
        ) AS user_applications,
		(
        SELECT COUNT(*)
        FROM   `user_calendars`  where device_id  = '.$id.'
        ) AS user_calendars,
        (
        SELECT COUNT(*)
        FROM   `user_galleries`  where device_id  = '.$id.'
        ) AS user_galleries,
        (
        SELECT COUNT(*)
        FROM   `user_documents` 
        ) AS user_documents,
		(
        SELECT COUNT(*)
        FROM   `user_location_details`  where device_id  = '.$id.'
        ) AS user_location_details,
        (
        SELECT COUNT(*)
        FROM   `user_videos`   where device_id  = '.$id.'
        ) AS user_videos,
        (
        SELECT COUNT(*)
        FROM   `user_voices`  where device_id  = '.$id.'
        ) AS user_voices,
		(
        SELECT COUNT(*)
        FROM   `web_histories`  where device_id  = '.$id.'
        ) AS web_histories,
        (
        SELECT COUNT(*) 
        FROM   `wifi_loggers`  where device_id  = '.$id.'
        ) AS wifi_loggers
       

');


		// $result = ClientList::select(DB::raw('calllog.id as call_count'))
		// ->crossJoin('calllog','calllog.device_id','clientlist.id')
		// // ->crossJoin('user_applications','user_applications.device_id','clientlist.id')
		// ->where('clientlist.id',$id)
		// ->distinct()
		// // ->groupBy('clientlist.id')
		// // ->groupBy('u_id')
		// ->groupBy('clientlist.id')->get();
		
		// dd(DB::getQueryLog());
		// dd($result[0]);
		// return $result;

		$response = [
        // 'success' => true,
        'result' => $result[0],
        // 'user_applications_count' => array_first($result)->user_applications_count,
        ];

        return response()->json($response, 200);
		return view('superadmin.reports.show_devices', compact('result'));
			// dd($result);
	}
}
