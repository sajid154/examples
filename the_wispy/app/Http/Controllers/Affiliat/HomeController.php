<?php

namespace App\Http\Controllers\Affiliat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\TraficLogs;
use App\User;
use App\AgentCommision;
use Illuminate\Database\Eloquent\Builder;
use DB;
use Hash;
use App\AgentDetails;
use App\Message;


class HomeController extends Controller
{
    public function index()
    {
         // these links use affiliate user to share others

        $home_page  = ('https://www.thewispy.com/');
        $price_page = ('https://www.thewispy.com/pricing/');
        $demo_page  = (url('demo-login-user'));


        
        // dd(auth()->user());

        $tCustomer = User::where('ref_code', auth()->user()->agent_details->reference_code)->count();
        // dd(Carbon::now()->firstOfMonth()->toDateTimeString());
        $cCustomer = User::where('ref_code', auth()->user()->agent_details->reference_code)
                            ->whereBetween('created_at', [Carbon::now()->firstOfMonth()->toDateTimeString(),
                            Carbon::now()->lastOfMonth()->toDateTimeString()])
                            ->count();

        $commisons = User::where('ref_code', auth()->user()->agent_details->reference_code)
                    ->whereBetween('created_at', [Carbon::now()->firstOfMonth()->toDateTimeString(),
                            Carbon::now()->lastOfMonth()->toDateTimeString()])
                    ->get();

        $totalCustomers = count($commisons); 
        $ratio = null;
        $currentMonthCommision = 0;


        if($totalCustomers > 0 && $totalCustomers < 100) {
                    $ratio = 40;

        }else if($totalCustomers >= 100 && $totalCustomers < 200){
                    $ratio = 45;
        }else if($totalCustomers >= 200){
                    $ratio = 50;
        }

        foreach($commisons as $commison){
                if($commison->plans()->first() != null){
                    $countComision = ($ratio/100) * $commison->plans()->first()->cost_price;
                    $currentMonthCommision += (float)$countComision;
                }

        }

     
        $earnedCommision =  auth()->user()->commisions->where('status', 1)->sum('amount');
        
        $commisionsStatus = AgentCommision::where('agent_id', auth()->user()->id)->orderBy('id', 'desc')->take(12)->get();
        
        $commisionsStatus = $commisionsStatus->reverse();

        // dd($commisionsStatus);



        return view('agent.index', compact('tCustomer', 'cCustomer', 'currentMonthCommision', 'earnedCommision', 'commisionsStatus','price_page','home_page','demo_page'));
    }


    public function logs()
    {
        $traficLogs = TraficLogs::where('ref_code', auth()->user()->agent_details->reference_code)->orderBy('id', 'desc')->paginate(25);

        return view('agent.traficlogs.index', compact('traficLogs')); 
    }


    public function commissions()
    {
        $commissions = AgentCommision::where('agent_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(12);

        return view('agent.commisions.index', compact('commissions'));
    }



    public function getProfile()
    {
        return view('agent.edit_account');
    }



    public function updateProfile(Request $request)
    {
        if($request->password != null){
        $request->validate([
            'name' => 'required',
            'password'=> ['string', 'min:8', 'confirmed'],
            'street_address'=>'required',
            'additional_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'zip_code'=>'required'
        ]);
    }
    else if($request->password == null){
         $request->validate([
            'name' => 'required',
            'street_address'=>'required',
            'additional_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'zip_code'=>'required'
        ]);
    }  

        
        DB::beginTransaction();

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $userSave = $user->save();


        $agentDetail = AgentDetails::where('agent_id', auth()->user()->id)->update([

                'company_name' => $request->company_name,
                'company_website' => $request->company_website,
                'street_address' => $request->street_address,
                'additional_address' => $request->additional_address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
                'zip_code' => $request->zip_code,
                'paypal_account' => $request->paypal_account,
                'bank_ac_title' => $request->bank_ac_title,
                'bank_name' => $request->bank_name,
                'bank_iban' => $request->bank_iban
                    
        ]);

        if($userSave && $agentDetail){

            DB::commit();
            return redirect()->route('login');

        }
        else{
            DB::rollback();
             return redirect()->back();

        }

        
    }



    public function getMessages()
    {
        $messages = Message::where('agent_id', auth()->user()->id)->get();
        return view('agent.messages', compact('messages'));
    }


public function saveMessage(Request $request){



        Message::create(['agent_id'=>auth()->user()->id, 'message'=>$request->message, 'is_seen'=>0, 'type'=>'Sender']);

        return redirect('/affiliate/messages');
    }
    
}
