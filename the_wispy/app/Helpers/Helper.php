<?php

/**
 * change plain number to formatted currency
 *
 * @param $number
 * @param $currency
 */
use  Omnipay\Common\CreditCard;

use App\DeviceSlots;
use App\ClientList;
use App\Plan;
use Carbon\Carbon;

use Omnipay\Common\Exception\InvalidCreditCardException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Payment;
use Illuminate\Support\Facades\Auth;

use Morrislaptop\Firestore\Factory;
use Kreait\Firebase\ServiceAccount;

function stripe_process($device_slots, $gateway, $pcon=null)
{
    $today = Carbon::now()->format('Y-m-d');
    if (sizeof($device_slots) > 0) {
        foreach ($device_slots as $index => $value) {

            $device_start_date = Carbon::parse($value->device_start_date)->format('Y-m-d');
            $device_end_date = Carbon::parse($value->device_end_date)->format('Y-m-d');
            $device_expiration_date = Carbon::parse($value->device_expiration_date)->format('Y-m-d');
            if ($device_start_date <= $today) {
                // echo $value->id;
                // dd("ASsaa");
                $res = payment_charge($value, $gateway);
                // dump("Charge Payment from Buyer after One Month");
                $device_slot = DeviceSlots::find($value->id);
                tap($device_slot)->update([
                    'payment_id' => $res->id
                ]);
                $client = ClientList::where('uniqueid', $value->device_id);
                tap($client)->update([
                    'device_start_date' => $device_slot->device_start_date,
                    'device_end_date' => $device_slot->device_end_date,
                    'device_expiration_date' => $device_slot->device_expiration_date,
                    'payment_id' => $res->id,
                    'subscribed' => '1'
                ]);
            } else {

                // echo "string";
                if ($pcon == 1) {
                    return "this_device_is_not_expired";
                } else {
                    dd("ba");
                    dump("$value->device_id_d, this device is not expired to renewal");
                }

            }
        }
        return "device_renewal_success";
    }
}
function payment_process($device_slots, $gateway, $pcon=null){

    $today = Carbon::now()->format('Y-m-d');
    //dd($today);
    if(sizeof($device_slots)>0){
        // echo "string";
        //$device_start_date = array();
        foreach ($device_slots as $index => $value) {
            $device_start_date = Carbon::parse($value->device_start_date)->format('Y-m-d');
            $device_end_date = Carbon::parse($value->device_end_date)->format('Y-m-d');
            $device_expiration_date = Carbon::parse($value->device_expiration_date)->format('Y-m-d');
            //dd($device_start_date);
            if( $device_start_date <= $today  ){
                 //dd($value->id);
                // dd("ASsaa");
                $res = payment_charge($value, $gateway);
                //dd($res);
                // dump("Charge Payment from Buyer after One Month");
                $device_slot = DeviceSlots::find($value->id);
                tap($device_slot)->update([
                    'payment_id' => $res->id
                ]);
                $client = ClientList::where('uniqueid',$value->device_id);
                tap($client)->update([
                    'device_start_date' => $device_slot->device_start_date,
                    'device_end_date' => $device_slot->device_end_date,
                    'device_expiration_date' => $device_slot->device_expiration_date,
                    'payment_id' => $res->id,
                    'subscribed' => '1'
                ]);
				dump("$value->device_id_d, this device charged");
			}
            else{

                // echo "string";
                if($pcon == 1){
                    return "this_device_is_not_expired";
                }
                else{
                    //dd("ba");
                    dump("$value->device_id_d, this device is not expired to renewal");
                }

            }
        }
        return "device_renewal_success";
    }
    return "No pending Payment for today";

}


function payment_charge($data , $gateway)
{
    \Stripe\Stripe::setApiKey('sk_test_51HDO7vEfn8C1oBfVvj3iYMCw5vLkTWT4FadgcydgXDYvq7IcfgY8X1l0PD0LT9GqM73KmwePdj4cwHFwdZP0sYyi00mYfOMtBl');
    try {
        $token = \Stripe\Token::create(array(
            "card" =>[
                'number' => '4242424242424242',
                'exp_month' => '12',
                'exp_year' => '2024',
                'cvc' => '123'
            ]
        ));
        $response = \Stripe\Charge::create(array(
            "amount" => "15"*100,
            "currency" => "usd",
            "description" => "Test payment.",
            "card" => $token,
        ));
        //dd($response);
        $isPaymentExist = Payment::where('payment_id', $response['balance_transaction'])->first();
        if(!$isPaymentExist)
        {
            $random = str_random(30);
            $payment = new Payment;
            $payment->payment_id = $response['balance_transaction'];
            $payment->payer_id = $response['id'];
            $payment->user_id = $data['user_id'];
            $payment->payer_email = 'umjutt786@gmail.com';
            $payment->amount = '5';
            $payment->currency = $response['currency'];
            $payment->plan_id = $data['plan_id'];
            $payment->payment_status = $response['status'];
            $payment->device_id = $data['device_id'];
            $payment->save();
            return $payment;
        }
    }
    catch ( \Exception $e ) {
        dd($e);
        Session::flash ( 'fail-message', "Error! Please Try again." );
        return redirect('plans');
    }

}

function saveLogs($request,$UserLogs)
{


    ini_set('max_file_uploads', 200);
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_execution_time', 10000000);

    $result=array();

    $device_id = str_replace('\"', '', $request->device_id);
    $device_id = str_replace('"', '', $device_id);
    // dd($device_id);

    $device = ClientList::where('uniqueid','=',"$device_id")->first();
    // return ;
    // echo "string";

    return $device;
    if($device){

        if($request->hasFile($UserLogs)){
            // dd($UserLogs);
            for($i=0; $i < count($request->$UserLogs); $i++){
                // $filename = $request->$UserLogs[$i]->getClientOriginalName();

                $file = $request->$UserLogs[$i]->getClientOriginalName();

                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if (!file_exists( storage_path() ."/app/public/$UserLogs/". $filename.'_'.$device->id.'.'.$extension)) {



                    $data['path'] = $request->$UserLogs[$i]->move(storage_path("/app/public/$UserLogs"),$filename.'_'.$device->id.'.'.$extension );

                    $data['path'] = $filename.'_'.$device->id.'.'.$extension;

                    $data['date_time'] = date("Y-m-d", strtotime($request->date_time));
                    $data['device_id'] = $request->id;

                    $result[]= DB::table($UserLogs)->insert($data);
                    $message = strtoupper(str_replace('_',' ',$UserLogs)).' inserted successfully.';

                }
                else{
                    $message = strtoupper(str_replace('_',' ',$UserLogs)).' already Exists.';
                }

            }
            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);
        }
    }else{
        return response()->json([
            'success' => true,
            'message' => "Device Id not Exists.",
        ], 404);
    }
}
function get_month_days($plan_id){
    // dd($plan_id);
    $plan_days = Plan::with('month')->where('plans.id', $plan_id)->first();
    return $plan_month_days = $plan_days->month['month_days'];

}

function add_slots($value, $res){
    // dump($value);
    // dd($res);
    $plan_month_days =  get_month_days($value->plan_id);
    // dd($plan_month_days);


    $plan_month = $plan_month_days/30;

    for ($i=0; $i < $plan_month ; $i++) {
        if($i == 0){
            $payment_id = $res->id;
            $client = ClientList::find($value->device_id_d);
            tap($client)->update([
                'device_start_date' => Carbon::now()->addMonths($i+1-1),
                'device_end_date' => Carbon::now()->addMonths($i+1),
                'device_expiration_date' => Carbon::now()->adddays($plan_month_days),
            ]);

        }else{
            $payment_id = 0;
        }
        DeviceSlots::create(
            [
                'plan_id'=> $value->plan_id,
                'device_id' => $value->uniqueid,
                'device_id_d' => $value->device_id_d,
                'payment_id' => $payment_id,
                'user_id' => $value->user_id,
                'price' => $res->amount,
                'device_start_date' => Carbon::now()->addMonths($i+1-1),
                'device_end_date' => Carbon::now()->addMonths($i+1),
                'device_expiration_date' => Carbon::now()->adddays($plan_month_days),
            ]);

    }
}


function get_graph_data($request, $id){
        $result = 
    DB::select('SELECT  (
        SELECT COUNT(*)
        FROM   calllog where device_id =  '.$id.'
        ) AS Calllogs,
         (
        SELECT COUNT(*)
        FROM   `contacts`    where device_id = '.$id.'
        ) AS Contacts,
        (
        SELECT COUNT(*)
        FROM   `smses`   where device_id  = '.$id.'
        ) AS Sms,
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
        ) AS wifi_loggers,
        (
        SELECT COUNT(*)
        FROM   capture_screenshots where device_id =  '.$id.'
        ) AS capture_screenshots,
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
        FROM   `take_pictures`  where device_id  = '.$id.'
        ) AS take_pictures
       

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

        if($request->ajax()){
          // dd("asasa");
            return response()->json($response, 200);  
        }
        return (array)$result;
        
  }

/*


        $result = 
    DB::select('SELECT      (
        SELECT COUNT(*)
        FROM   `smses`   where device_id  = '.$id.'
        ) AS Sms,
        (
        SELECT COUNT(*)
        FROM   calllog where device_id =  '.$id.'
        ) AS Calls,
        (
        SELECT COUNT(*)
        FROM   capture_screenshots where device_id =  '.$id.'
        ) AS CaptureScreenshots,
         (
        SELECT COUNT(*)
        FROM   `contacts`    where device_id = '.$id.'
        ) AS Contacts,
        (
        SELECT COUNT(*)
        FROM   `record_video`  where device_id  = '.$id.' 
        ) AS record_video,

        (
        SELECT COUNT(*)
        FROM   `take_pictures`  where device_id  = '.$id.'
        ) AS Pictures,
        (
        SELECT COUNT(*)
        FROM   `user_applications`  where device_id  = '.$id.'
        ) AS Applications,
    (
        SELECT COUNT(*)
        FROM   `user_calendars`  where device_id  = '.$id.'
        ) AS Calendars,
        (
        SELECT COUNT(*)
        FROM   `user_galleries`  where device_id  = '.$id.'
        ) AS Gallery
        
       

');

*/
     function encrypt_attr($data){
              $value = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($data).'" , "dAtAbAsE98765432")) as encrypted');
          return  $value = $value[0]->encrypted;
    }

    function get_user_location($request){

    $user_ip = $request->getClientIp();
            // $user_ip = getenv('75.136.201.84');
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $state = $geo["geoplugin_region"];

      return  $res = [
        'last_login_at' => Carbon::now()->toDateTimeString(),
        'last_login_ip' =>  $user_ip,
        'country_state_city' =>  $country . '_' .$state . '_' .$city
        ];

    }


         function up_data($client_id, $status){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/thewispy-6b883-ad4d94865c93.json');

        $firestore = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->createFirestore();

        $collection = $firestore->collection('users');
        $user = $collection->document($client_id);

        // Save a document
        $user->set([
        'expired' => $status ]);
        }
