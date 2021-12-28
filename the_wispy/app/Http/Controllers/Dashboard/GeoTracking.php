<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use App\LocationDetail;
use App\Location;
use DataTables;
use App\Clientlist;
use App\GeoFence;
use App\UserGeoFenceStatus;
class GeoTracking extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // return "saa";
        $clientlist = \App\ClientList::find($id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
        $device_id = $clientlist->id;
        $current_location = Location::where('device_id', $device_id)->latest()->first();
        $clientlists = LocationDetail::where('device_id', $device_id)->get();
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
        $user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();

        // $current_location1 = ['latitude' => $current_location['latitude'], 'longitude' => $current_location['longitude'], 'address' => $current_location['address'] ];

        // $current_location = collect($current_location1);
        $geo_fences = $clientlist->geo_fences;
     
        // dd($current_location);
        return view ('user.geo_track',compact('geo_fences', 'clientlists','clientlist','current_location','device_id','plan_id','id','user_id'));
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
}
