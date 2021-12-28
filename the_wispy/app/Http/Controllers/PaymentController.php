<?php

namespace App\Http\Controllers;
use Omnipay\Common\CreditCard;
use Omnipay\Common\GatewayFactory;
use Omnipay\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\PaymentSuccessEmail;
use App\Payment;
use App\ClientList;
use App\DeviceSlots;
use App\ClientListPlans;
use App\Plan;
use App\Coupon;
use Carbon\Carbon;
use DB;
use DateTime;
use DateTimeZone;
use Omnipay\Common\Exception\InvalidCreditCardException;
use Symfony\Component\HttpFoundation\ParameterBag;

use Illuminate\Support\Facades\Auth;
use Session;


class PaymentController extends Controller
{
    //

    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Express');
        /*  $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));  */
        // $this->gateway->setUsername('ltdss.jd_api1.gmail.com');
        // $this->gateway->setPassword('K2D6HFR5Z9X3DW7L');
        // $this->gateway->setSignature('A3bGH27SxpA5baY.y3vROHFTc9tZAdCGvFt2T0dt.0qfUQjur57X5peW');
        $this->gateway->setUsername('x.imran96-facilitator_api1.gmail.com');
        $this->gateway->setPassword('3JGVWMJVHVBS4BJA');
        $this->gateway->setSignature('Afa5jluOd1eJh2mSZf2kpMooC6d1Ac89m2xnQ9wUrPbv1d-L7FciqqAy');
        $this->gateway->setTestMode(false);  //set it to 'false' when go live

    }

    public function index()
    {
        return view('payment');
    }
    public function trail(Request $request)
	{
		if($request->input('payintegration'))
            $request->session()->flash('plan_id', $request->plan_id);
        $request->session()->flash('client_id', $request->client_id);
        $request->session()->flash('amount', $request->amount);
		$random = str_random(30);
		$request->session()->flash('unique_id', $random);
		$session_id = session()->get('plan_id_sess');
		$session = session()->all();
		//dd($session);
		$session_plan = session()->get('plan_id_sess');
        $session_client_id = session()->get('client_id');
        $session_amount = session()->get('amount');
		$plan_days = Plan::with('month')->where('plans.id', $session_plan)->first();
                $plan_month_days = $plan_days->month['month_days'];
		$data = [
                    'random' => $random,
                    'session_plan' => $session_plan,
                    'amount' => $session_amount,
                    'plan_month_days' => $plan_month_days,
                ];
					$payment = new Payment;
                    $payment->payment_id = "free";
                    $payment->payer_id = "trail";
                    $payment->user_id = Auth::user()->id;
                    $payment->payer_email = Auth::user()->email;
                    $payment->amount = $session_amount;
                    $payment->currency = "USD";
                    $payment->plan_id = $session_plan;
                    $payment->payment_status = "Completed";
                    $payment->device_id = $random;
                    $payment->save();
		if(empty($session_client_id)){
                    // return "Asa";
                    $this->insert_to_client_list_trail($data);
                }
				else{
                    $client = ClientList::find($session_client_id);
                    tap($client)->update([
                        'plan_id' => $session_plan
                    ]);
                    ClientListPlans::where('clientlist_id', $session_client_id)
                        ->update(['plan_status' => '0']);

                    $clientlist_plans =  array(
                        // 'clientlist_id' => $session_client_id,
                        'plan_id' => $session_plan,
                        'user_id' => Auth::user()->id,
                        'uniqueid'=> $client->uniqueid,
                        'plan_status' => 1,
                        'payment_id' => "free",

                    );
                    $client->clientlist_plans()->create($clientlist_plans);
                    
                    // DeviceSlots::where('payment_id',0)->where('device_id', $client->uniqueid)->delete();

                    // $res = DeviceSlots::whereNotNull('payment_id')
                    //     ->where('device_id', $client->uniqueid)
                    //     ->select('device_start_date','device_end_date','device_expiration_date')
                    //     ->orderBY('id', 'desc')
                    //     ->first();
                    // $today = Carbon::today()->format('Y-m-d');
                    // $device_expiration_date = Carbon::parse($res->device_expiration_date)->format('Y-m-d');

                    // $device_end_date = $res->device_end_date;

                    // if($today <= $device_expiration_date)
                    // {

                    //     $device_date = $res->device_end_date;

                    // }
                    // else{
                    //     $device_date = Carbon::now();
                    // }

                    // $plan_month = $plan_month_days/30;

                    // for ($i=0; $i < $plan_month ; $i++) {
                    //     if($i == 0){
                    //         $payment_id = $payment->id;
                    //         $client = ClientList::find($session_client_id);
                    //         tap($client)->update([
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    //     }else{
                    //         $payment_id = 0;
                    //     }
                    //     DeviceSlots::create(
                    //         [
                    //             'plan_id'=> $session_plan,
                    //             'device_id' => $client->uniqueid,
                    //             'device_id_d' => $client->id,
                    //             'payment_id' => $payment_id,
                    //             'user_id' => Auth::user()->id,
                    //             'price' => $payment->amount,
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    // }
                }
				$email = Auth::user()->email;
				//$to_email = ['zahiddotcom@hotmail.com','support@thewispy.com','kallistisix@gmail.com'];
                // Mail::to($email)->send(new SendMail());
                return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');

	}

	public function thankYou() {
		return view('user.thankYou');
	}



	public function charge(Request $request)
    {
        // return"as";
        // dd($request->all());
        if($request->input('payintegration'))
            $request->session()->flash('plan_id', $request->plan_id);
        $request->session()->flash('client_id', $request->client_id);
        $request->session()->flash('amount', $request->amount);
        $request->session()->flash('first_name', $request->first_name);
        $request->session()->flash('last_name', $request->last_name);
        $request->session()->flash('address', $request->address);
        $request->session()->flash('city', $request->city);
        $request->session()->flash('phone', $request->phone);
        // $session = session()->all();
        // dd($session);

        // dd(auth()->user());

        $plan = Plan::find($request->plan_id);

        $cost_price = '';

        if($plan != null){
            $cost_price = $plan->cost_price;
        }else{
            session()->flash('invalid', "Please select a Plan");
            return redirect('/devices');
        }
        if($request->get_coupon_code != null){

            $coupon = Coupon::where('coupon_code', $request->get_coupon_code)->first();
            if($coupon->amount_type === 'Percentage'){
            $discount = ($coupon->amount/100) * $cost_price;
            $cost_price = $cost_price-$discount;
            $cost_price = number_format((float)$cost_price, 2, '.', '');
            }
            else if($coupon->amount_type === 'Fixed'){
                $cost_price = $cost_price-$coupon->amount;
            }
          
        }

       

        {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $cost_price,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();
                //dd("trin");
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function payment_success(Request $request)
    {
        // dd(session::all());
        $session_plan = session()->get('plan_id_sess');
        $session_client_id = session()->get('client_id');
        $session_amount = session()->get('amount');

        // Once the transaction has been approved, we need to complete it.

        if ($request->input('paymentId') && $request->input('PayerID') )
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();

                if(!$isPaymentExist)
                {
                    $random = str_random(30);

                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->user_id = Auth::user()->id;
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = "USD";
                    $payment->plan_id = $session_plan;
                    $payment->payment_status = $arr_body['state'];
                    $payment->device_id = $random;
                    $payment->save();
                }

                $plan_days = Plan::with('month')->where('plans.id', $session_plan)->first();
                $plan_month_days = $plan_days->month['month_days'];

                $data = [
                    'random' => $random,
                    'session_plan' => $session_plan,
                    'payment_id' => $payment->id,
                    'amount' => $payment->amount,
                    'plan_month_days' => $plan_month_days,
                ];

                if(empty($session_client_id)){
                    $this->insert_to_client_list($data);
                }
                else{

            $today = Carbon::now()->format('Y-m-d');
            $client = ClientList::find($session_client_id);

if(isset($client)){
    $device_end_date = Carbon::parse($client->device_end_date)->format('Y-m-d');
$client_list_id  = (!empty($client->uniqueid)?$client->uniqueid:"no");
    up_data($client_list_id,'No');


    if ($device_end_date >= $today) {

        tap($client)->update([
            'plan_id' => $session_plan,
            'payment_id' => $payment->id,
            'expired' => 'No',
            // 'device_start_date' => $client->device_end_date,
            'device_end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            'device_expiration_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days)

            ]);

    }
    else{
        tap($client)->update([
            'plan_id' => $session_plan,
            'payment_id' => $payment->id,
            'expired' => 'No',
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays($plan_month_days),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days)
            ]);
    }
}


                    ClientListPlans::where('clientlist_id', $session_client_id)
                        ->update(['plan_status' => '0']);

                    $clientlist_plans =  array(
                        // 'clientlist_id' => $session_client_id,
                        'plan_id' => $session_plan,
                        'user_id' => Auth::user()->id,
                        'uniqueid'=> $client->uniqueid,
                        'plan_status' => 1,
                        'payment_id' => $payment->id,

                    );
                    $client->clientlist_plans()->create($clientlist_plans);
                    // ClientListPlans::create($clientlist_plans);
// return "asa";
                    // DeviceSlots::where('payment_id',0)->where('device_id', $client->uniqueid)->delete();

                    // $res = DeviceSlots::whereNotNull('payment_id')
                    //     ->where('device_id', $client->uniqueid)
                    //     ->select('device_start_date','device_end_date','device_expiration_date')
                    //     ->orderBY('id', 'desc')
                    //     ->first();

                    // // return $res->device_expiration_date->isToday();
                    // $today = Carbon::today()->format('Y-m-d');
                    // $device_expiration_date = Carbon::parse($res->device_expiration_date)->format('Y-m-d');

                    // $device_end_date = $res->device_end_date;

                    // if($today <= $device_expiration_date)
                    // {

                    //     $device_date = $res->device_end_date;

                    // }
                    // else{
                    //     $device_date = Carbon::now();
                    // }

                    // $plan_month = $plan_month_days/30;

                    // for ($i=0; $i < $plan_month ; $i++) {
                    //     if($i == 0){
                    //         $payment_id = $payment->id;
                    //         $client = ClientList::find($session_client_id);
                    //         tap($client)->update([
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    //     }else{
                    //         $payment_id = 0;
                    //     }
                    //     DeviceSlots::create(
                    //         [
                    //             'plan_id'=> $session_plan,
                    //             'device_id' => $client->uniqueid,
                    //             'device_id_d' => $client->id,
                    //             'payment_id' => $payment_id,
                    //             'user_id' => Auth::user()->id,
                    //             'price' => $payment->amount,
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    // }


                    // DeviceSlots::

// return "successful";




                    //     $task = ClientList::find($session_client_id);
                    //     $task->device_status = "inactive";
                    //     $task->save();
                    //     $newTask = $task->replicate();
                    //     $newTask->plan_id = $session_plan; // the new project_id
                    //     $newTask->parent_id = $session_client_id; // the new project_id
                    //     $newTask->payment_id = $payment->id; // the new project_id
                    //     $newTask->device_status = "active"; // the new project_id
                    //     // $newTask->renewal_date = Carbon::now(); // the new project_id
                    //     // $newTask->plan_upgradation_date = Carbon::now(); // the new project_id
                    //     $newTask->device_start_date = Carbon::now();
                    //      // the new project_id
                    //     $newTask->device_end_date = Carbon::now()->adddays($plan_month_days);
                    //      // the new project_id
                    //     // $newTask->renewal_date = Carbon::now(); // the new project_id
                    //     $newTask->save();

                }
                $email = Auth::user()->email;
                 Mail::to($email)->send(new SendMail($data));
                return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');
            } else {
                return $response->getMessage();
            }
        } elseif ($request->input('PayerID')) {

            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'amount' => $session_amount,
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['PAYMENTINFO_0_TRANSACTIONID'])->first();
                if(!$isPaymentExist)
                {
                    $random = str_random(30);

                    $payment = new Payment;
                    $payment->payment_id = $arr_body['PAYMENTINFO_0_TRANSACTIONID'];
                    $payment->payer_id = $request->input('PayerID');
                    $payment->user_id = Auth::user()->id;
                    $payment->payer_email = Auth::user()->email;
                    $payment->amount = $session_amount;
                    $payment->currency = "USD";
                    $payment->plan_id = $session_plan;
                    $payment->payment_status = $arr_body['PAYMENTINFO_0_PAYMENTSTATUS'];
                    $payment->device_id = $random;
                    $payment->save();
                }

                $plan_days = Plan::with('month')->where('plans.id', $session_plan)->first();
                $plan_month_days = $plan_days->month['month_days'];


                $data = [
                    'random' => $random,
                    'session_plan' => $session_plan,
                    'payment_id' => $payment->id,
                    'amount' => $payment->amount,
                    'plan_month_days' => $plan_month_days,
                ];
                $data_email = [
                    'random' => $random,
                    'session_plan' => $session_plan,
                    'payment_id' => $payment->payment_id,
                    'amount' => $payment->amount,
                    'plan_month_days' => $plan_month_days,
                    'payer_id' => $payment->payer_id,
                    'payment_status' => $arr_body['PAYMENTINFO_0_PAYMENTSTATUS'],
                    'user_email' => $payment->payer_email,
                    'first_name' => session()->get('first_name'),
                    'last_name' => session()->get('last_name'),
                    'phone' => session()->get('phone'),
                    'city' => session()->get('city'),
                    'address' => session()->get('address'),
                ];

                if(empty($session_client_id)){
                    $this->insert_to_client_list($data);
                }
                else{
            $today = Carbon::now()->format('Y-m-d');
            $client = ClientList::find($session_client_id);

if(isset($client)){
    $device_end_date = Carbon::parse($client->device_end_date)->format('Y-m-d');
$client_list_id  = (!empty($client->uniqueid)?$client->uniqueid:"no");
        up_data($client_list_id,'No');

        
    if ($device_end_date >= $today) {

        tap($client)->update([
            'plan_id' => $session_plan,
            'payment_id' => $payment->id,
            'expired' => 'No',
            // 'device_start_date' => $client->device_end_date,
            'device_end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            'device_expiration_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days)

            ]);

    }
    else{
        tap($client)->update([
            'plan_id' => $session_plan,
            'payment_id' => $payment->id,
            'expired' => 'No',
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays($plan_month_days),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days)
            ]);
    }
}

                    ClientListPlans::where('clientlist_id', $session_client_id)
                        ->update(['plan_status' => '0']);

                    $clientlist_plans =  array(
                        // 'clientlist_id' => $session_client_id,
                        'plan_id' => $session_plan,
                        'user_id' => Auth::user()->id,
                        'uniqueid'=> $client->uniqueid,
                        'plan_status' => 1,
                        'payment_id' => $payment->id,
                    );
                    $client->clientlist_plans()->create($clientlist_plans);
                    // ClientListPlans::create($clientlist_plans);
// return "asa";
                    // DeviceSlots::where('payment_id',0)->where('device_id', $client->uniqueid)->delete();

                    // $res = DeviceSlots::whereNotNull('payment_id')
                    //     ->where('device_id', $client->uniqueid)
                    //     ->select('device_start_date','device_end_date','device_expiration_date')
                    //     ->orderBY('id', 'desc')
                    //     ->first();

                    // // return $res->device_expiration_date->isToday();
                    // $today = Carbon::today()->format('Y-m-d');
                    // $device_expiration_date = Carbon::parse($res->device_expiration_date)->format('Y-m-d');

                    // $device_end_date = $res->device_end_date;

                    // if($today <= $device_expiration_date)
                    // {

                    //     $device_date = $res->device_end_date;

                    // }
                    // else{
                    //     $device_date = Carbon::now();
                    // }

                    // $plan_month = $plan_month_days/30;

                    // for ($i=0; $i < $plan_month ; $i++) {
                    //     if($i == 0){
                    //         $payment_id = $payment->id;
                    //         $client = ClientList::find($session_client_id);
                    //         tap($client)->update([
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    //     }else{
                    //         $payment_id = 0;
                    //     }
                    //     DeviceSlots::create(
                    //         [
                    //             'plan_id'=> $session_plan,
                    //             'device_id' => $client->uniqueid,
                    //             'device_id_d' => $client->id,
                    //             'payment_id' => $payment_id,
                    //             'user_id' => Auth::user()->id,
                    //             'price' => $payment->amount,
                    //             'device_start_date' => Carbon::parse($device_date)->addMonths($i+1-1),
                    //             'device_end_date' => Carbon::parse($device_date)->addMonths($i+1),
                    //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                    //         ]);

                    // }


                    // DeviceSlots::

// return "successful";




                    //     $task = ClientList::find($session_client_id);
                    //     $task->device_status = "inactive";
                    //     $task->save();
                    //     $newTask = $task->replicate();
                    //     $newTask->plan_id = $session_plan; // the new project_id
                    //     $newTask->parent_id = $session_client_id; // the new project_id
                    //     $newTask->payment_id = $payment->id; // the new project_id
                    //     $newTask->device_status = "active"; // the new project_id
                    //     // $newTask->renewal_date = Carbon::now(); // the new project_id
                    //     // $newTask->plan_upgradation_date = Carbon::now(); // the new project_id
                    //     $newTask->device_start_date = Carbon::now();
                    //      // the new project_id
                    //     $newTask->device_end_date = Carbon::now()->adddays($plan_month_days);
                    //      // the new project_id
                    //     // $newTask->renewal_date = Carbon::now(); // the new project_id
                    //     $newTask->save();

                }
                $request->session()->flash('unique_id', $random);
                $session = session()->get('unique_id');
                $email = Auth::user()->email;
                $emails_admin = ['zahiddotcom@hotmail.com','support@thewispy.com'];
                Mail::to($email)->send(new SendMail($data));
                // Mail::to($emails_admin)->send(new PaymentSuccessEmail($data_email));
                return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');
            } else {
                return $response->getMessage();
            }
        }
        else {
            return 'Transaction is declined';
        }

    }

    public function insert_to_client_list($data){
        // dd($data);
        $random = $data['random'];
        $plan_id = $data['session_plan'];
        $payment_id = $data['payment_id'];
        $price = $data['amount'];
        $plan_month_days = $data['plan_month_days'];

        $client= ClientList::create([
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_id' => $plan_id,
            'payment_id' => $payment_id,
            'device_status' => "inactive",
            'expired' => 'No',
            'subscribed' => 1,
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays($plan_month_days),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days)
        ]);
        $client_list_id  = (!empty($client->uniqueid)?$client->uniqueid:"no");
        up_data($client_list_id, 'No');
        $clientlist_plans =  array(
            'plan_id' => $plan_id,
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_status' => 1,
            'payment_id' => $payment_id,
        );
        $client->clientlist_plans()->create($clientlist_plans);

        // $plan_month = $plan_month_days/30;

        // for ($i=0; $i < $plan_month ; $i++) {
        //     // $i =
        //     if($i == 0){
        //         $payment_id = $payment_id;
        //     }else{
        //         $payment_id = 0;
        //     }
        //     DeviceSlots::create(
        //         [
        //             'plan_id'=> $plan_id,
        //             'device_id' => $random,
        //             'device_id_d' => $client->id,
        //             'payment_id' => $payment_id,
        //             'user_id' => Auth::user()->id,
        //             'price' => $price,
        //             'device_start_date' => Carbon::now()->addMonths($i+1-1),
        //             'device_end_date' => Carbon::now()->addMonths($i+1),
        //             'device_expiration_date' => Carbon::now()->adddays($plan_month_days),
        //         ]);
        // }
    }public function insert_to_client_list_trail($data){
        // dd($data);
        $random = $data['random'];
        $plan_id = $data['session_plan'];
        $price = $data['amount'];
        $plan_month_days = $data['plan_month_days'];

        $client= ClientList::create([
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_id' => $plan_id,
            'device_status' => "inactive",
            'subscribed' => 1,
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays(5),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days)
        ]);

        $clientlist_plans =  array(
            'plan_id' => $plan_id,
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_status' => 1,
            'payment_id' => "free",
        );
        $client->clientlist_plans()->create($clientlist_plans);
    }

    public function payment_error()
    {
        return redirect('checkout')->with('msg', 'Payment has been cancelled by the user.');
    }

    public function plan_renewal(Request $request)
    {

        $number = $request->number;
        $expiryMonth = $request->expiryMonth;
        $expiryYear = $request->expiryYear;
        $cvv = $request->cvv;
        $device_id = $request->device_id;
        $plan_id = $request->plan_id;

        $today = Carbon::now()->format('Y-m-d');

        DeviceSlots::
        whereDate( 'device_end_date','<', $today)
            ->where('payment_id',0)->update([
                'payment_id' => 2
            ]);


        $device_slots = DeviceSlots::where('plan_id',$plan_id)
            ->where('user_id',Auth::user()->id)
            ->where('device_id_d', $device_id)
            ->where('payment_id', 0)
            ->groupBy('device_id_d')->get();
        // echo "string";
        // $device_slots = $db_data->where('payment_id' ,0)->get();
        // dd($devic
        // dd($device_slots);
        if(sizeof($device_slots) > 0){
            // dd("one device found to charge ");
            $pcon =1;
            $resp =   payment_process($device_slots, $this->gateway, $pcon);
            // dd($resp);
            if($resp == "this_device_is_not_expired"){
                return redirect()->back()->with('pcon',"This device is not expired");
            }
            else{
                return redirect()->back()->with('pcon',"You have successfully update your plan ");
            }

        }else{
            // return "else";
            $last_device_slots = DeviceSlots::where('plan_id',$plan_id)
                ->where('user_id',Auth::user()->id)
                ->where('device_id_d', $device_id)
                ->where('payment_id','!=', 0)
                ->select('*')
                ->addSelect(DB::raw('device_id as uniqueid'))
                ->get()->last();
            // dd($last_device_slots );
            // return $last_device_slots + ['abc' => 12];
            $res =   payment_charge($last_device_slots , $this->gateway);
            add_slots($last_device_slots, $res);
            return redirect()->back()->with('pcon',"You have successfully update your plan.");

            dd($last_device_slots);
        }



        // dd($device_slots);


// if(sizeof($device_slots)>0){

//       foreach ($device_slots as $key => $value) {

//     $device_end_date = Carbon::parse($value->device_end_date)->format('Y-m-d');

//         if($today >= $device_end_date){
//             // echo $value->id;
//           $res = $this->payment_success_renewal($value);

//     dump("Charge Payment from Buyer after One Month");
// // dd($res->payment_id);
//         $device_slot = DeviceSlots::find($value->id);
//          tap($device_slot)->update([
//             'payment_id' => $res->id
//         ]);

// // exit();
//     $client = ClientList::where('uniqueid',$value->device_id);
//          tap($client)->update([
//             'device_start_date' => $device_slot->device_start_date,
//             'device_end_date' => $device_slot->device_end_date,
//             'device_expiration_date' => $device_slot->device_expiration_date,
//             'payment_id' => $res->id,
//             'subscribed' => '1'
//             ]);

//               }
//               else{
//                 dump("xyz");
//               }
//           }

//           dd("end");
//         }


        // echo Auth::user()->id;
        // return $request->all();
        // return redirect()->back();
        // dd("dfd");
    }

//     public function payment_success_renewal($data){

//      $formInputData = array(
//         'firstName' => 'noman',
//         'lastName' => 'shah',
//         'number' => '4329068336469187',
//         'expiryMonth' =>'02',
//         'expiryYear'=>'2023',
//         'cvv'=>'123',
//         'billingAddress1' =>'dublin',
//         'billingPostcode' =>'12345',
//         'billingState' =>'california',
//         'billingCountry' =>'US',
//         'billingPhone' =>'03038869074',
//         'billingCity'=>'dublin',
//         'email' =>'nomanshah587@yahoo.com'
//               );
// //dd($formInputData);
//         $card = new CreditCard($formInputData);
//         // Send purchase request
//         $response = $this->gateway->purchase(
//             [
//                 'amount' => $data->price,
//                 'currency' => 'USD',
//                 'card' => $card,
//             ]
//         )->send();
//         // dd($response);
//         // Process response
//         if ($response->isSuccessful()) {

//                 $arr_body = $response->getData();
//               // dd($arr_body);            // Insert transaction data into the database
//                 $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
//                 if(!$isPaymentExist)
//                 {
//                     $payment = new Payment;
//                     $payment->payment_id = $arr_body['id'];
//                     $payment->payer_id = '123';
//                     $payment->user_id = $data->user_id;
//                     $payment->payer_email = 'aliraza@a.com';
//                     $payment->amount = $arr_body['transactions'][0]['amount']['total'];
//                     $payment->currency = env('PAYPAL_CURRENCY');
//                     $payment->plan_id = $data->plan_id;
//                     $payment->payment_status = $arr_body['state'];
//                     // dd($payment);
//                     $payment->save();
//                     return $payment;
//                 }

//         } elseif ($response->isRedirect()) {
//            // dd($response);
//             // Redirect to offsite payment gateway
//             $response->redirect();
//         } else {
//             // Payment failed
//             echo $response->getMessage();
//         }
//          exit();

//     }
    public function charge_difference(Request $request){
        $device_id = $request->device_id;
        // $amount = $request->difference;
        // $data = array('device_id' => $device_id, 'amount' => $amount);
        // return $data;
        if($request->price > 0){
            $data = $request->all() + ['user_id' => Auth::user()->id ];
            $res =   payment_charge($data, $this->gateway);
            if($res){

                DeviceSlots::where('payment_id',0)->where('device_id_d', $device_id)->delete();

                ClientList::find($device_id)->update([
                    'subscribed' => '0'
                ]);
            }
        }
        else{
            // return "subscribed";
            DeviceSlots::where('payment_id',0)->where('device_id_d', $device_id)->delete();

            ClientList::find($device_id)->update([
                'subscribed' => '0'
            ]);
        }
        return "success";
    }
	public function trialVersionUSer(Request $request){
        {
            $random = str_random(30);
            $payment = new Payment;
            $payment->payment_id = "free";
            $payment->payer_id = "trail";
            $payment->user_id = Auth::user()->id;
            $payment->payer_email = Auth::user()->email;
            $payment->amount = '0';
            $payment->currency = "USD";
            $payment->plan_id = 16;
            $payment->payment_status = "Completed";
            $payment->device_id = $random;
            $payment->save();
        }
        $client= ClientList::create([
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_id' => 16,
            'payment_id' => $payment->payment_id,
            'device_status' => "inactive",
            'subscribed' => 1,
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays(3),
            'device_expiration_date' => Carbon::now()->adddays(3),

        ]);

    $clientlist_plans =  array(
            'plan_id' => 16,
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_status' => 1,
            'payment_id' => $payment->id,
        );
        $client->clientlist_plans()->create($clientlist_plans);

		$data = [
                'random' => $client->uniqueid,];
				$email = Auth::user()->email;
				// Mail::to($email)->send(new SendMail($data));
		$request->session()->flash('key', $random);
		$key = session()->get('key');
        return redirect('devices');
		//Redirect::to('devices',$random)
	}
}
