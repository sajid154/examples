<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserCalendars;
use DataTables;

class CalendarsController extends Controller
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
        // $clientlists = UserCalendars::where('device_id', $session)->get();
        $device_id = $clientlist->id; 
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
		$user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();
		return view ('user.userCalendars',compact('device_id','plan_id','id','user_id'));
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
        $clientlists = UserCalendars::where('device_id', $request->device_id)->orderBy('id','desc')->get();

        if ($request->ajax()) {

            return Datatables::of($clientlists)

        ->editcolumn('title', function($data){
                return $data['title'];
            })
        ->editcolumn('event_location', function($data){
                return  $data['event_location'];
            })              
        ->editcolumn('description', function($data){
                return $data['description'];
            })


                // ->editColumn('start_time', function($clientlists) {
                //     return date('M d,Y, h:i:s A', strtotime($clientlists->start_time)) ;
                // })
                // ->editColumn('finish_time', function($clientlists) {
                //     return date('M d,Y, h:i:s A', strtotime($clientlists->finish_time)) ;
                // })
                ->make(true);
        }
      
        return view('users');
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
