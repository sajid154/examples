<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InstagramSms;
use App\ClientList;
use DataTables;


class InstagramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $device = ClientList::find($id);
        $iSms = InstagramSms::where('device_id', $device->id)->groupBy('contact_name')->get();
        return view('user.instagram_sms', compact('iSms', 'id', 'device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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



    public function default(Request $request)
    {
        $number_val = encrypt_attr($request->number_val);

        $device_id =  $request->device_id;
       $data = InstagramSms::where('device_id', $device_id)
        ->when($number_val , function($qeury) use ($number_val){
            $qeury->where('contact_name', $number_val);    
        })->get();
        

        if ($request->ajax()) {


            return Datatables::of($data)
              ->addColumn('date_time_f', function ($data) {
            return date('g:i A', strtotime($data->time));
            })
            ->addColumn('intro', function ($data) {
                    return date('M,d Y', strtotime($data->created_at));
                })
            ->editcolumn('message', function($data){
                return $data['message'];
            })
            ->addColumn('date_time', function($data){
            return date('M,d Y', strtotime($data->created_at));
            })
            ->editcolumn('status', function($data){
                return $data['status'];
            })
            ->make(true);
        }
      
        return view('users');
    }
}
