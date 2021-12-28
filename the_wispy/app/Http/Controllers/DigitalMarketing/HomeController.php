<?php

namespace App\Http\Controllers\DigitalMarketing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Message;
use App\AgentDetails;
use Hash;

class HomeController extends Controller
{
    public function index(){
        return view('digital.index');
    }

    public function getAgents()
{
    // dd(Cookie::get('ref_code'));
    $agents = User::with('agent_details')->whereHas('roles', function($query){
        $query->where('name','=','Agent');
    })->paginate(25);

    return view('digital.agents', compact('agents'));

}


public function agentApprove(Request $request, $id)
{

    $agentApprove = AgentDetails::find($id);
    $agentApprove->status = 1;
    $agentApprove->save();
    return back()->with('success', 'Agent approved...');
}



public function agentDisapprove(Request $request, $id)
{
    $agentApprove = AgentDetails::find($id);
    $agentApprove->status = 0;
    $agentApprove->save();
    return back()->with('success', 'Agent Un-Approved...');
}


    public function getProfile()
    {
        return view('digital.edit_account');
    }

    public function updateProfile(Request $request)
    {

       // dd($request->all());
        $request->validate([
            'name' => 'required',
            'password'=> ['string', 'min:8', 'confirmed'],

        ]);
  
        
        // DB::beginTransaction();

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $userSave = $user->save();

        if($userSave){

            // DB::commit();
            return redirect('/marketing');

        }
        else{
            // DB::rollback();
             return redirect()->back();

        }

        
    }




    public function getAgentsMessages()
    {
   
    $messages = null;
   
     $agents = User::whereHas('roles', function($query){
        $query->where('name','=','Agent');
        })->get();

    return view('digital.messages', compact('agents', 'messages'));

    }

    public function getMessages($agent_id)
    {
   
    $messages = Message::where('agent_id', $agent_id)->get();
   
     $agents = User::whereHas('roles', function($query){
        $query->where('name','=','Agent');
        })->get();

    return view('digital.messages', compact('agents', 'messages'));

    }


public function saveMessage(Request $request, $agent_id){



        Message::create(['agent_id'=>$agent_id, 'message'=>$request->message, 'is_seen'=>0, 'type'=>'Receiver']);

        return redirect('/market/messages/'.$agent_id);
}



        public function getAgentCustomers($ref_code)
        {
                $customers = User::with('plans')->where('ref_code', $ref_code)->paginate(25);

        // dd($customers[0]->plans->first()->title);
              return view('digital.agent_customers', compact('customers'));
        }

}
