<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientList;
use App\Location;
use App\LocationDetail;
use App\Http\Controllers\API\BaseController as BaseController;

class UserLocationController extends Controller
{
    public function userlocations(Request $request)
    {

        try {


      // return response()->json([
      //   'success' => false,
      //    'message'=> $request->all(),
      //   ], 404);

// dd($request->all());
      // dd($request->current_location);

     $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
     if($device){
      // dd($request->current_location['date_time']);


      $requestd = $request->current_location;
      // echo "string";
      // return $request->current_location;


      $requestd['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', $requestd['date_time']))); 


      $location = Location::updateorcreate([ 'device_id' => $device->id ],$requestd + [ 'device_id' => $device->id ]);
      if($location){

        foreach ($request->user_loctions as $key => $value) {
            $value['device_id'] = $device->id;



            $value['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', $value['date_time']))); 


            $latitude = encrypt_attr($value['latitude']);
            $longitude = encrypt_attr($value['longitude']);
            $address = encrypt_attr($value['address']);


            $location_details = $location->location_details()->updateorcreate(
              [ 'latitude' => $latitude,'longitude' => $longitude,'address' => $address ],$value);
        }
      }
      // if($location_details){
      return response()->json([
        'success' => true,
         // 'data'=> $location_details,
        'message' =>[ "Current location and Recent location added successfully."],
        ], 200);
      // }
    }
    else{
      // echo "else";exit();
                  return response()->json([
                  'success' => false,
                   'message'=> ["Device does't exist."],
                  ], 200);
    }

                        }
         
     catch (\Exception $ex) {


      // dd($ex->gettrace());
       return response()->json([
            'success' => false,
            'message' =>  [
              Str_limit($ex->getMessage(),150), 'On Line '. $ex->getline() ,'File Path '. $ex->getfile()  
            ],
              
          ]);
}


  }
    public function check_location_status(Request $request){

      $device_id = $request->device_id;
     
      $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
  
       if($device){

            $client = Location::where('device_id',$device->id)->first();

              if(isset($client)){

              tap($client)->update([
                  'status' => $request->status
              ]);
      
              return response()->json([
              'success' => true,
               'message'=>[ "Location Status Updated successfully."],
              ], 200);

          }
       }
    }
}
