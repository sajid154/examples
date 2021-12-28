<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\AgentCommision;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\Currency;
class SettingController extends Controller
{
    

        public function apiContext()
        {
                return new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        env('PAYPAL_CLIENT_ID', 'AeQltO-lMM629OFzzJtFxeePSnszKWqjLq_wGflDs_rUBbRvZqchkVs3r9fNBwkisRK2eYcHSoXgua6N'),
                        env('PAYPAL_CLIENT_SECRET', 'EAPX_gMeL9ORm5LfpoGUC3vR5O3yecUtYAJELaCQ0VNSxr8IfmTMSH76luVXKtIwFYstPHFH93Oy91XP')
                    )
                );
        }


        public function commissions()
        {
            $commissions = DB::table('percentage_ratio')->get();
            return view('superadmin.commissions.index', compact('commissions'));
        }

        public function getCommission($id)
        {
            $commission = DB::table('percentage_ratio')->find($id);
            
            return view('superadmin.commissions.edit', compact('commission'));    
        }

        public function updateCommission(Request $request, $id)
        {
            $commission = DB::table('percentage_ratio')->where('id', $id)->update(['ratio'=>$request->ratio]);
            // dd($commission);
            // return view('superadmin.commissions.edit', compact('commission')); 
            return redirect()->route('commissions-index'); 
        }


        public function getAgentPaymentHistory($agent_id)
        {
           $user = User::with('roles')->find($agent_id);
           $ifAgent = $user->roles->first();
           if($ifAgent->name !== 'Agent'){
                return back()->with('un-success', "Agent didn't exist");
           }

            $commissions = AgentCommision::where('agent_id', $agent_id)->orderBy('id', 'desc')->paginate(12);
            return view('superadmin.reports.agent_history', compact('commissions', 'user'));

        }

        public function getAgentPaymentPay($agent_id, $pay_id)
        {
            $user = User::with('roles')->find($agent_id);
           $ifAgent = $user->roles->first();
           
           if($ifAgent->name !== 'Agent'){
                return back()->with('un-success', "Agent didn't exist");
           }
            
            $commission  = AgentCommision::find($pay_id);
            
            return view('superadmin.reports.agent_pay', compact('commission', 'user'));
        }



        // paypal pay

        public function payCommissionPaypal(Request $request)
        {
        
        
        $getCommission = AgentCommision::find($request->pay_id);
      
        
         $payouts = new Payout();

        
         $senderBatchHeader = new PayoutSenderBatchHeader();

         $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");

            $senderItem = new \PayPal\Api\PayoutItem();
            $senderItem->setRecipientType('Email')
                ->setNote('Thanks for Supporting The Wispy')
                ->setReceiver($request->account)
                ->setSenderItemId(time())
                ->setAmount(new Currency(
                            '{
                                "value":"'.$getCommission->amount.'",
                                "currency":"USD"
                            }'));

        $payouts->setSenderBatchHeader($senderBatchHeader)
        ->addItem($senderItem);

        $apiContext = $this->apiContext();

        $apiContext->setConfig(['mode' => 'sandbox']);

        try {
        
             $output = $payouts->create(null, $this->apiContext());

            // dd($output->batch_header->payout_batch_id);

            $transaction = Payout::get($output->batch_header->payout_batch_id, $apiContext);

            $getCommission->status = 1;
            $getCommission->payment_method = 'PayPal';
            $getCommission->transection_id = $transaction->items[0]->transaction_id;
            $getCommission->save();

            return redirect('/agent-users')->with('success', 'We have made successfull payout...');

            } catch (Exception $ex) {
                return $ex;
            
            }


        }


        public function payCommissionBank(Request $request)
        {

            $getCommission = AgentCommision::find($request->pay_id);

            $recipt_name = null;
            
            if($request->hasFile('recipt')){


                    $file = $request->file('recipt');

                    $recipt_name = time() .'_'.  $file->getClientOriginalName();

// dd($recipt_name);

                    $file->move(public_path("recipts", $recipt_name));

                    // $file->move(storage_path("/app/public/bank_recipts", $recipt_name));

            }
            
            $getCommission->status = 1;
            $getCommission->payment_method = "Bank";
            $getCommission->bank_recipt = $recipt_name;
            $getCommission->save();
                return redirect('/agent-users')->with('success', 'We have made successfull payout...');

         
        }

}
