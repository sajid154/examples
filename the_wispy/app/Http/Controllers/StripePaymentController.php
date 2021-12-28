<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use App\Mail\UpgradeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessEmail;
use App\Payment;
use App\ClientList;
use App\DeviceSlots;
use App\ClientListPlans;
use App\Plan;
use Carbon\Carbon;
use DB;
use DateTime;
use DateTimeZone;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Redirect;
use Session;


class StripePaymentController extends Controller
{

    public function ScaPay(Request $request){

// dd($request->all());

/*          old uk old_key
  pk_live_51H7dtWFgzQEcLQlOJh7ZzxNz8qdB7khAd0L5AVWwAQGXBhnQcv3EO0wO8cyxUaBbbqHglbPWs25Ku9i8IkkmOdoI003VLR7Mbb*/
  
        //old uk key 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

        
        $request->session()->flash('client_id', $request->client_id);
        $request->session()->flash('oldkey', $request->old_key);
        $request->session()->flash('plan_id', $request->plan_id);
        $request->session()->flash('pay_amount', $request->amount);
        $session_old_key = session()->get('oldkey');
        $pay_amount = request()->all();
        //dd($pay_amount);
        Stripe::setApiKey('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');
         $payment_intent = PaymentIntent::create([
        "amount" => $request->input('amount') *100,
        'currency' => 'usd',
      ]);
         //dd($payment_intent);
      return response()->json([
          'clientSecret' => $payment_intent->client_secret,
          'id' => $payment_intent->id,
      ]);
    }


    public function paymentProcess(Request $request){
        // dd($request->all());
        $session_old_key = session()->get('oldkey');
        Stripe::setApiKey('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');
        $intent = \Stripe\PaymentIntent::retrieve($request->payment_intent);

        try {

    if ($intent->status == 'succeeded')
        {

            $isPaymentExist = Payment::where('payment_id', $intent->charges->data[0]->balance_transaction)->first();
        if(!$isPaymentExist && !$session_old_key)
            {
                $random = str_random(30);
            $payment = new Payment;
            $payment->payment_id = $intent->charges->data[0]->balance_transaction;
            $payment->payer_id = $intent->charges->data[0]->id;
            $payment->user_id = Auth::user()->id;
            $payment->payer_email = $request->input('email');
            $payment->amount = $request->input('amount');
            $payment->currency = $intent->charges->data[0]->currency;
            $payment->plan_id = $request->input('plan_id');
            $payment->payment_status = $intent->charges->data[0]->status;       
            $payment->device_id = $random;
            $payment->save();
            }

        else{

            $payment = new Payment;
            $payment->payment_id = $intent->charges->data[0]->balance_transaction;
            $payment->payer_id = $intent->charges->data[0]->id;
            $payment->user_id = Auth::user()->id;
            $payment->payer_email = $request->input('email');
            $payment->amount = $request->input('amount');
            $payment->currency = $intent->charges->data[0]->currency;
            $payment->plan_id = $request->input('plan_id');
            $payment->payment_status = $intent->charges->data[0]->status;       
            $payment->device_id = $session_old_key;
            $payment->save();
        }

            $session_client_id = session()->get('client_id');

            
            $plan_days = Plan::with('month')->where('plans.id', $payment->plan_id)->first();
            $plan_month_days = $plan_days->month['month_days'];
            $data = [
                'random' => $payment->device_id,
                'session_plan' => $payment->plan_id,
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
                'plan_month_days' => $plan_month_days,
                'payer_name' => $request->input('name'),
                'card_number_III' => encrypt_attr($intent->charges->data[0]->payment_method_details->card['last4']),
                // 'cvv' => '111',
                 'card_expire_month' => $intent->charges->data[0]->payment_method_details->card['exp_month'],
                'card_expire_year' => $intent->charges->data[0]->payment_method_details->card['exp_year'],
                'card_details' => $intent->charges->data[0]
            ];
            if(empty($session_client_id)){
                $this->insert_to_client_list($data);
            }
            else {

                $today = Carbon::now()->format('Y-m-d');
                $client = ClientList::find($session_client_id);



if(isset($client)){
    $device_end_date = Carbon::parse($client->device_end_date)->format('Y-m-d');

        $client_list_id  = (!empty($client->uniqueid)?$client->uniqueid:"no");
        up_data($client_list_id, 'No');


    if ($device_end_date >= $today) {

        tap($client)->update([
            'plan_id' => $payment->plan_id,
            'payment_id' => $payment->id,
            'payer_name' => $request->input('name'),
            'expired' => 'No',
                    // $card = $data['card'],
                // $arr = str_split($card,6),
                    // $cvv = $data['cvv'],
            $card_expire_month = $data['card_expire_month'],
            $card_expire_year = $data['card_expire_year'],
                    // 'card_number_I' => encrypt_attr($arr['0']),
                    // 'card_number_II' => encrypt_attr($arr['1']),
            'card_number_III' => encrypt_attr($data['card_number_III']),
                    // 'cvv' => encrypt_attr($cvv),
            'card_expire_month' => $card_expire_month,
            'card_expire_year' => $card_expire_year,
             // 'device_start_date' => $client->device_end_date,
            'device_end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            'device_expiration_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            'card_details' => $data['card_details']

                ]);

    }
    else{
        
        tap($client)->update([
            'plan_id' => $payment->plan_id,
            'payment_id' => $payment->id,
            'payer_name' => $request->input('name'),
            'expired' => 'No',
                    // $card = $data['card'],
                // $arr = str_split($card,6),
                    // $cvv = $data['cvv'],
            $card_expire_month = $data['card_expire_month'],
            $card_expire_year = $data['card_expire_year'],
                    // 'card_number_I' => encrypt_attr($arr['0']),
                    // 'card_number_II' => encrypt_attr($arr['1']),
            'card_number_III' => encrypt_attr($data['card_number_III']),
                    // 'cvv' => encrypt_attr($cvv),
            'card_expire_month' => $card_expire_month,
            'card_expire_year' => $card_expire_year,
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays($plan_month_days),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days),
            'card_details' => $data['card_details']

        ]);
    }
}

            //     tap($client)->update([
            //         'plan_id' => $payment->plan_id,
            //         'payer_name' => $request->input('name'),
            //         // $card = $data['card'],
            //         // $arr = str_split($card,6),
            //         // $cvv = $data['cvv'],
            //         $card_expire_month = $data['card_expire_month'],
            //         $card_expire_year = $data['card_expire_year'],
            //         // 'card_number_I' => encrypt_attr($arr['0']),
            //         // 'card_number_II' => encrypt_attr($arr['1']),
            //         'card_number_III' => encrypt_attr($data['card_number_III']),
            //         // 'cvv' => encrypt_attr($cvv),
            //         'card_expire_month' => $card_expire_month,
            //         'card_expire_year' => $card_expire_year,
            //  // 'device_start_date' => $client->device_end_date,
            // 'device_end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            // 'device_expiration_date' => Carbon::createFromFormat('Y-m-d H:i:s', $client->device_end_date)->adddays($plan_month_days),
            // 'card_details' => $data['card_details']

            //     ]);





                ClientListPlans::where('clientlist_id', $session_client_id)
                    ->update(['plan_status' => '0']);
                $clientlist_plans = array(
                    // 'clientlist_id' => $session_client_id,
                    'plan_id' => $payment->plan_id,
                    'user_id' => Auth::user()->id,
                    'uniqueid' => $client->uniqueid,
                    'plan_status' => 1,
                    'payment_id' => $payment->id,
                );
                $client->clientlist_plans()->create($clientlist_plans);
                // DeviceSlots::where('payment_id', 0)->where('device_id', $client->uniqueid)->delete();

                // $res = DeviceSlots::whereNotNull('payment_id')
                //     ->where('device_id', $client->uniqueid)
                //     ->select('device_start_date', 'device_end_date', 'device_expiration_date')
                //     ->orderBY('id', 'desc')
                //     ->first();
                // $today = Carbon::today()->format('Y-m-d');
                // $device_expiration_date = Carbon::parse($res->device_expiration_date)->format('Y-m-d');

                // $device_end_date = $res->device_end_date;

                // if ($today <= $device_expiration_date) {

                //     $device_date = $res->device_end_date;

                // } else {
                //     $device_date = Carbon::now();
                // }

                // $plan_month = $plan_month_days / 30;

                // for ($i = 0; $i < $plan_month; $i++) {
                //     if ($i == 0) {
                //         $payment_id = $payment->id;
                //         $client = ClientList::find($session_client_id);
                //         tap($client)->update([
                //             'device_start_date' => Carbon::parse($device_date)->addMonths($i + 1 - 1),
                //             'device_end_date' => Carbon::parse($device_date)->addMonths($i + 1),
                //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                //         ]);

                //     } else {
                //         $payment_id = 0;
                //     }
                //     DeviceSlots::create(
                //         [
                //             'plan_id' => $payment->plan_id,
                //             'device_id' => $client->uniqueid,
                //             'device_id_d' => $client->id,
                //             'payment_id' => $payment_id,
                //             'user_id' => Auth::user()->id,
                //             'price' => $payment->amount,
                //             'device_start_date' => Carbon::parse($device_date)->addMonths($i + 1 - 1),
                //             'device_end_date' => Carbon::parse($device_date)->addMonths($i + 1),
                //             'device_expiration_date' => Carbon::parse($device_date)->adddays($plan_month_days),
                //         ]);
                // }
            }
            Session::flash ( 'success-message', 'Payment done successfully !' );
            $email = Auth::user()->email;
            if(empty($session_client_id)){
            Mail::to($email)->send(new SendMail($data));
            return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');}
            else{
                // Mail::to($email)->send(new UpgradeMail($data));
                return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');
            }
        }
        else
            {
                $plan_title = Plan::where('id' ,$request->plan_id)->first();
                $request->session()->put('plan_id_sess', $plan_title->id);
                $request->session()->put('title', $plan_title->title);
                $request->session()->put('description', $plan_title->description);
                $request->session()->put('cost_price', $plan_title->cost_price);
                $request->session()->put('type', $plan_title->type);
            return redirect('/checkout',)->with('plan',$plan_title)->with('error', 'Card Information is not Correct');
            }

        }


        catch ( \Exception $e ) {
            dd($e);
            return redirect('checkout')->with('msg', $e->getError()->message);
        }
    }
    public function thankYou() {
        return view('user.thankYou');
    }
    public function insert_to_client_list($data){
        // dd($data);
        $random = $data['random'];
        $plan_id = $data['session_plan'];
        $payer_name = $data['payer_name'];
        $payment_id = $data['payment_id'];
        $price = $data['amount'];
        $plan_month_days = $data['plan_month_days'];
        // $card = $data['card'];
        // $card_without_space = str_replace(' ', '', $card);
        // $arr = str_split($card_without_space,6);
        // $cvv = $data['cvv'];
        $card_expire_month = $data['card_expire_month'];
        $card_expire_year = $data['card_expire_year'];
        $card_number_III = encrypt_attr($data['card_number_III']);
        $card_details = $data['card_details'];

        $client= ClientList::create([
            'user_id' => Auth::user()->id,
            'uniqueid'=> $random,
            'plan_id' => $plan_id,
            'payment_id' => $payment_id,
            'payer_name' => $payer_name,
            'device_status' => "inactive",
            'expired' => 'No',
            'subscribed' => 1,
            'device_start_date' => Carbon::now(),
            'device_end_date' => Carbon::now()->adddays($plan_month_days),
            'device_expiration_date' => Carbon::now()->adddays($plan_month_days),
            'card_number_III' => $card_number_III,
            'card_expire_month' => $card_expire_month,
            'card_expire_year' => $card_expire_year,
            'card_details' => $card_details
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
    }
    public function trialVersionUSer(){
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
        $data = [
                'random' => $client->uniqueid,];
                $email = Auth::user()->email;
                Mail::to($email)->send(new SendMail($data));
        return redirect('thanks')->with('status', 'Kindly check your email for Lisence Key!');
    }
    // public function ScaPay(Request $request){
    //     $request->session()->flash('client_id', $request->client_id);
    //     $request->session()->flash('oldkey', $request->old_key);
    //     $request->session()->flash('plan_id', $request->plan_id);
    //     $request->session()->flash('pay_amount', $request->amount);
    //     $session_old_key = session()->get('oldkey');
    //     $pay_amount = request()->all();
    //     //dd($pay_amount);
    //     Stripe::setApiKey('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');
    //      $payment_intent = PaymentIntent::create([
    //     "amount" => $request->input('amount') *100,
    //     'currency' => 'usd',
    //   ]);
    //      //dd($payment_intent);
    //   return response()->json([
    //       'clientSecret' => $payment_intent->client_secret,
    //       'id' => $payment_intent->id,
    //   ]);
    // }
    // public function paymentProcess(Request $request){
    //     Stripe::setApiKey('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');
    //     $intent = \Stripe\PaymentIntent::retrieve($request->payment_intent);
    //     //dump($intent->charges->data[0]);
    //     if ($intent->status == 'succeeded')
    //     {
    //         $random = str_random(30);
    //         $payment = new Payment;
    //         $payment->payment_id = $intent->charges->data[0]->balance_transaction;
    //         $payment->payer_id = $intent->charges->data[0]->id;
    //         $payment->user_id = Auth::user()->id;
    //         $payment->payer_email = $request->input('email');
    //         $payment->amount = $request->input('amount');
    //         $payment->currency = $intent->charges->data[0]->currency;
    //         $payment->plan_id = $request->input('plan_id');
    //         $payment->payment_status = $intent->charges->data[0]->status;
    //         $payment->device_id = $random;
    //         $payment->save();
    //         $email = Auth::user()->email;
    //         $plan_days = Plan::with('month')->where('plans.id', $payment->plan_id)->first();
    //         $plan_month_days = $plan_days->month['month_days'];
    //         $data = [
    //             'random' => $payment->device_id,
    //             'session_plan' => $payment->plan_id,
    //             'payment_id' => $payment->id,
    //             'amount' => $payment->amount,
    //             'plan_month_days' => $plan_month_days,
    //             'card' => $request->input('card_number'),
    //             'payer_name' => $request->input('name'),
    //             'cvv' => $request->input('cvv'),
    //             'card_expire_month' => $request->input('card_expire_month'),
    //             'card_expire_year' => $request->input('card_expire_year'),
    //         ];
    //         Mail::to($email)->send(new SendMail($data));
    //         $this->insert_to_client_list($data);
    //         return redirect('thanks');
            
    //     }
    //     else
    //         {
    //             $plan_title = Plan::where('id' ,$request->plan_id)->first();
    //             $request->session()->flash('id', $plan_title->id);
    //             $request->session()->flash('title', $plan_title->title);
    //             $request->session()->flash('description', $plan_title->description);
    //             $request->session()->flash('cost_price', $plan_title->cost_price);
    //             $request->session()->flash('type', $plan_title->type);
    //         return redirect('/checkout',)->with('plan',$plan_title)->with('error', 'Card Information is not Correct');
    //     }
    // }
}
