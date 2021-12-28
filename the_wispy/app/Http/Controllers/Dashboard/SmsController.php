<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use DataTables;
use App\UserApplication;
use App\SMS;
use DB;
class SmsController extends Controller
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
        $request->session()->flash('device', $clientlist->id);
        $session = session()->get('device');
        // $clientlists = SMS::where('device_id', $clientlist->id)->groupBy('number')->get();
            // return $clientlists;

        $clientlists =  SMS::leftJoin('contacts','smses.number','contacts.number')
        ->select(DB::Raw("(CASE WHEN (contacts.name IS NOT NULL ) THEN contacts.name ELSE smses.number END) as contact_name"),'contacts.name','smses.message','smses.id','smses.number')
        ->where('smses.device_id', $clientlist->id)
        ->whereIn('smses.id', function($query){
            $query->select(DB::Raw('max(id)'))->from('smses')
            ->groupBy('smses.number')->orderBy('id','desc');
        })->orderBy('id','desc')
        
        ->get();
        // dd($clientlists);


        $device_id = $clientlist->id; 
        return view ('user.smses',compact('clientlists','session','id','device_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default(Request $request)
    {
        $number_val = encrypt_attr($request->number_val);
        $device_id =  $request->device_id;
        // echo "$number_val";
// return $device_id;
        $data = SMS::where('device_id', $device_id)
        ->when($number_val , function($qeury) use ($number_val){
            $qeury->where('number', $number_val);    
        })->orderBy('id', 'desc')->get();
        

        if ($request->ajax()) {

            return Datatables::of($data)
              ->addColumn('date_time_f', function ($data) {
            return date('g:i:s A', strtotime($data->date_time));
            })
            ->addColumn('intro', function ($data) {
                    return date('M,d Y', strtotime($data->date_time));
                })
            ->editcolumn('message', function($data){
                return $data['message'];
            })
            ->editcolumn('type', function($data){
                return $data['type'];
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
