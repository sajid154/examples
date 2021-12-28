<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientList;
use App\PlanFeatures;
use App\DeviceSlots;
use App\DevicesFeatures;
use App\ClientListPlans;
use App\Plan;
use DB;
use Auth;
class DeviceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // dd($id);
        $client_data =  ClientList::Join('plans','plans.id','clientlist.plan_id')->where('clientlist.id', $id)->first();
        

 $user_plans = ClientListPlans::Join('clientlist','clientlist.id','device_plans.clientlist_id')
        ->Join('plans','plans.id','device_plans.plan_id')
            ->join('payments','payments.id','device_plans.payment_id')    
                    ->select('plans.title','plans.type','payments.amount','payments.payer_email','payments.currency','payments.created_at','clientlist.device_start_date','clientlist.device_end_date')
                         ->where('device_plans.clientlist_id', $id )
                            ->get();

        // $user_plans =  ClientList::Join('plans','plans.id','clientlist.plan_id')
        // ->join('payments','payments.id','clientlist.payment_id')
        // ->join('device_plans','device_plans.id','clientlist.payment_id')
        

       

        // dd($user_plans);

        $assigned_features = PlanFeatures::with('features')
        ->where('plans_id', $client_data->plan_id)
        ->get();
        $selected_features = DevicesFeatures::where('uniqueid',$id)->get();
// echo "string";
        // dd($assigned_features);
       return view('user.user_devices',compact('id','assigned_features','selected_features','client_data','user_plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->device_id;
        $features = $request->feature_id;
        DB::enableQueryLOg();
        $plans =  ClientList::Join('plans','plans.id','clientlist.plan_id')
        ->join('plans_features','plans_features.plans_id','plans.id')
        ->where('clientlist.id', $id)->get();


       // dump($plans);
       //  dd($features);

        
        // dd(DB::getQueryLog());

        // $plans = DB::table('plans_features')->where('plans_id', $client_data->plan_id)->get();
 DevicesFeatures::where('uniqueid',$id)->delete();
        if(!empty($plans)){
        if(!empty($features)){

        

            foreach ($plans as $plan) 
            {
        if (in_array($plan->feature_id, $features)) {
                DevicesFeatures::create([ 
                 'user_id' => Auth::user()->id,
                    'uniqueid'=> $id,
                    'plan_id' => $plan->plans_id,
                    'features_id' => $plan->feature_id
             ]);
         }
            }
        }
    }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function unsubscribe(Request $request)
    {

        // dump($request->all());
        $id = $request->id;
         // return $id;
        if($request->subscription_type == '1'){
            $subscription_type='0';
        }else{
            $subscription_type='1';
        }
        // return $subscription_type;
        // $subscription_type = $request->subscription_type;
    ClientList::where('id',$id)->update(['subscribed' => $subscription_type]);
    DeviceSlots::where('payment_id',0)->where('device_id_d', $id)->delete();

     // $response = [
     //    'success' => true,
     //    'message' => "You are Successfully Subscribed!",
     //    ];
     //    return response()->json($response, 200);
        return $subscription_type;
    }

    /*recurring part start */


//     public function unsubscribe(Request $request)
//     {

//         // dump($request->all());
//         $id = $request->id;
//          // return $id;
//         if($request->subscription_type == '1'){
//             $subscription_type='0';
//         }else{
//             $subscription_type='1';
//         }
//         // return $subscription_type;
//         // $subscription_type = $request->subscription_type;
//     // ClientList::where('id',$id)->update(['subscribed' => $subscription_type]);

//   $device_slots  = DeviceSlots::where('device_id_d', $id)->first();
//   $plan_id = $device_slots->plan_id;

//     $device_slots  = DeviceSlots::where('payment_id',0)->where('device_id_d', $id)->get();

//     /*get total number of deivces*/
//     if(sizeof($device_slots) > 0){
//      $device_slots_total = sizeof($device_slots);

//      // dump("total empty slots" .$device_slots_total);

//      /*get user plan-months*/

//      $plan_id = array_first($device_slots)->plan_id;

//      $plan_days = Plan::with('month')->where('plans.id', $plan_id)->first();
//      $plan_month_days = $plan_days->month['month_days'];

//      // dump("total plan_month_days". $plan_month_days);

//      $get_plan_months = $plan_month_days/30;

//     // dump("total months of plan" .$get_plan_months);

//     $used_slots = $get_plan_months - $device_slots_total;
//     // dump("used slots ". $used_slots);

//     if($used_slots < $get_plan_months){
//         // dump("used slots ". $used_slots);


//     $get_basic_plan_price = Plan::select('monthly_price')->first();
    
//     // dd($get_basic_plan_price->monthly_price);

//     $get_price_sum_of_used_plans = $used_slots * $plan_days->monthly_price;
//     $get_basic_plan_price = $used_slots * $get_basic_plan_price->monthly_price;

//        // dump("get price sum of used plans ". $get_price_sum_of_used_plans);
//        // dump("get price sum of basic plans". $get_basic_plan_price);

//      $get_plans_difference = $get_basic_plan_price - $get_price_sum_of_used_plans;
//      // dump("get_plans_difference".$get_plans_difference);
//     //     return $get_plans_difference;
//     // if($get_plans_difference > 0){

//             $response = [
//             'success' => true,
//             'get_plans_difference' => $get_plans_difference,
//             'subscription_type' => $subscription_type,
//             'device_id' => $id,
//             'plan_id' => $plan_id
//             ];

//             return response()->json($response, 200);
//         // }


//         }
//     }
//     else{
// // return "else";
//     // ClientList::find($id)->update([
//     //             'subscribed' => '0'
//     //         ]);
//         $response = [
//         'success' => true,
//         'get_plans_difference' => 0,
//         'subscription_type' => $subscription_type,
//         'device_id' => $id,
//         'plan_id' => $plan_id
//         ];

//         return response()->json($response, 200);
//     return $subscription_type;
//         }
//     }

    /*recurring part ends */
}
