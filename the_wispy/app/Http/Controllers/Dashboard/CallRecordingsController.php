<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallRecordings;
use DataTables;
use DB;
class CallRecordingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {   
        // return "saa";
        $clientlist = \App\ClientList::find($id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
		//$user = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d','login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d as user-id');
		//dd($user);
        // $clientlists = CallRecordings::where('device_id', $session)->get();
        $device_id = $clientlist->id; 
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
        $user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();
		return view ('user.call_recordings',compact('device_id','plan_id','id','user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default(Request $request)
    {
        // $client_id =  $request->log_value;
        // $clientlist = \App\ClientList::find($client_id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
		// $clientlists = CallRecordings::where('device_id', $request->device_id)->get();

    $clientlists =  CallRecordings::leftJoin('contacts','call_recordings.number','contacts.number')
        ->select(DB::Raw("(CASE WHEN (contacts.name IS NOT NULL ) THEN contacts.name ELSE call_recordings.number END) as cont_name"),'call_recordings.date_time','call_recordings.id','call_recordings.duration','call_recordings.type','call_recordings.path')
        ->where('call_recordings.device_id', $request->device_id)
        ->groupBy('call_recordings.number')
        ->groupBy('call_recordings.id')
        ->get();
        // dd($clientlists);

                      return Datatables::of($clientlists)
                          ->editcolumn('cont_name', function($data){
                return $data['cont_name'];
            })
        ->editcolumn('number', function($data){
                return  $data['number'];
            })              
        ->editcolumn('type', function($data){
                return $data['type'];
            })
        // ->editcolumn('date_time', function($data){
        //         return  $data['date_time'];
        //     })
        ->editcolumn('duration', function($data){
                return $data['duration'];
            }) ->make(true);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
