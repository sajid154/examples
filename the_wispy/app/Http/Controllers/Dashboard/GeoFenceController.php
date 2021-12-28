<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use App\LocationDetail;
use App\Location;
use DataTables;
use App\Clientlist;
use App\GeoFence;
use App\UserGeoFenceStatus;
class GeoFenceController extends Controller
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
        $device_id = $clientlist->id;
        $current_location = Location::where('device_id', $device_id)->latest()->first();
        $clientlists = LocationDetail::where('device_id', $device_id)->get();
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
        $user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();

        // $current_location1 = ['latitude' => $current_location['latitude'], 'longitude' => $current_location['longitude'], 'address' => $current_location['address'] ];

        // $current_location = collect($current_location1);
        $geo_fences = $clientlist->geo_fences;
     
        // dd($current_location);
        return view ('user.geo_fencing',compact('geo_fences', 'clientlists','clientlist','current_location','device_id','plan_id','id','user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default(Request $request, $id)
    {
        $latitude = [];
        $longitude = [];
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $clientlists = LocationDetail::where('device_id', $id)->select('latitude','longitude')

            ->when($start_date && $end_date, function ($query) use ($start_date ,$end_date){
                $query->whereDate('date_time', '>=' ,$start_date )
                ->whereDate('date_time', '<=' ,$end_date );
            })
            ->get();

            foreach ($clientlists as $key => $value) {
                
                $latitude[] = $value->latitude;
                $longitude[] = $value->longitude;

            }

            // dd($longitude);

        return response()->json(['latitude' => $latitude, 'longitude' => $longitude], 200);  

       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
         $validatedData = $request->validate([
        'latitude' => 'required',
        'longitude' => 'required',
        'radius'=>'required'
        ]);


        $input = $request->all();

        $device = Clientlist::find($id);

        // $device->geo_fences()->create($input);
        $geo_fence = new GeoFence();
        $geo_fence->device_id = $device->id;
        $geo_fence->area_name = $request->area_name;
        $geo_fence->latitude = $request->latitude;
        $geo_fence->longitude = $request->longitude;
        $geo_fence->radius = $request->radius;
        $geo_fence->save();


        $SERVER_API_KEY = 'AAAAhE4QPLY:APA91bE0Dh1fGaQLI3RJTNvRNu9d6UpV_zj8APtcr-YDOXf_MvSDtwUukLQINOJwzgZdk8wpTsN1VDuQI4NaPWdOJYqyl7DIhAH__8PYlkW_GAqoy3oz_vdhOUaATj9ptx3Z-XefqIUC';
  
        $data = [
            "registration_ids" => [$device->device_token],
            // "registration_ids" => ["euLJG_U0T0uNzS008YNoDt:APA91bG_xjrLBToE4TW8e3thEXPmh4thXAl2HZiR7IRT68BJq10Gt2cRtqE0OsKt55PzZ7v7sct1OltqlDygXYzGihm3mKtubZg2akRllz6MDHLZXTgWHkW-KvmG2TM92cLAtbcfNAJj"],
            "data" => [
                "run_command" => "geo_fence",
                "geo_fence_id"=> $geo_fence->id,
                "area_name" => $geo_fence->area_name,
                "latitude" => $geo_fence->latitude,
                "longitude"=> $geo_fence->longitude,
                "range"=>$geo_fence->radius
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ]; 
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);
    
    


        return redirect('/geo-fence/'.$id)->with('success', 'Geo Fence Added successfully.');
        
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

        $geo_fence = GeoFence::find($id);
        $geo_fence->breach_logs()->delete();
        $geo_fence->delete();
        return redirect()->back()->with('success', 'Geo Fence removed successfully.');

    }

    public function add($id)
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
         return view ('user.add_geo_fencing',compact('clientlists','clientlist','current_location','device_id','plan_id','id','user_id'));
    }


    public function incomingLogs($id)
    {
        $device = ClientList::find($id);
        $incomingLogs = UserGeoFenceStatus::with('fence')->where('device_id', $device->id)->paginate(25);
       
        return view('user.geo_fence_logs', compact('incomingLogs', 'id'));
    }

    public function removeLog($id)
    {
        $fenceLog = UserGeoFenceStatus::find($id);
        $fenceLog->delete();
        
        return redirect()->back()->with('success', 'Geo Fence log removed successfully.');
    }


}
