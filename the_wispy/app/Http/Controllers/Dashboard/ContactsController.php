<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use DataTables;

class ContactsController extends Controller
{
	public function contacts(Request $request, $id)
    {   
        // return "saa";
        $clientlist = \App\ClientList::find($id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
        // $clientlists = Contact::where('device_id', $session)->get();
        $device_id = $clientlist->id; 
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
		$user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();
		return view ('user.contacts',compact('device_id','plan_id','id','user_id'));
    }
    public function default(Request $request)
    {
        // $client_id =  $request->log_value;
        // $clientlist = \App\ClientList::find($client_id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
        $data = Contact::where('device_id', $request->device_id)->groupBy('number')->get();

        if ($request->ajax()) {

            return Datatables::of($data)

        ->editcolumn('name', function($data){
                return $data['name'];
            })
        ->editcolumn('number', function($data){
                return  $data['number'];
            })


                    ->make(true);
        }
      
        return view('users');
    }
}
