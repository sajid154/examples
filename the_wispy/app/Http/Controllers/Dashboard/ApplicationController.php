<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use DataTables;
use App\UserApplication;
class ApplicationController extends Controller
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
        // $clientlists = CallLog::where('device_id', $session)->get();
        $device_id = $clientlist->id; 
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
		$user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();
		return view ('user.applications',compact('device_id','plan_id','id','user_id'));
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
        $data = UserApplication::where('device_id', $request->device_id)->get();

        if ($request->ajax()) {

            return Datatables::of($data)
            // ->editColumn('date_time', function ($data) {
            // return date('m/d/Y H:i:s', strtotime($data->date_time));
            // })

                   ->editcolumn('application_logo', function($data){
                return $data['application_logo'];
            })

                          ->editcolumn('application_name', function($data){
                return $data['application_name'];
            })
                               ->editcolumn('application_package_name', function($data){
                return $data['application_package_name'];
            })

                          ->editcolumn('application_time_usage', function($data){
                return $data['application_time_usage'];
            })

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
