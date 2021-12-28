<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientList;
use App\DeviceDetail;
use App\Http\Controllers\API\BaseController as BaseController;

class DeviceDetailController extends Controller
{
    public function deviceDetail(Request $request)
       {

          try {

     $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->first();
        // return $device;
          $data = $request->all();
           if($device){
            // echo "string";exit();
             $data['device_id'] = $device->id;
           
         $deviceDetail=   ClientList::where('uniqueid', $device_id)
          ->update(['number' => $request->number,'IMEI' => $request->IMEI,'manufacturer' => $request->manufacturer,
            'modal' => $request->modal,
            'device_status' => $request->device_status,
            'battery_level' => $request->battery_level,
            'network_carrier' => $request->network_carrier,
            'current_wifi' => $request->current_wifi,
            'child_age' => $request->child_age,
            'child_name' => $request->child_name,
            'device_token' => $request->device_token,
            'android_os' => $request->android_os,
            'plug_status' => $request->plug_status,
            'apk_version' => $request->apk_version,
            'is_done' => $request->is_done,
            'device_location_status' => $request->device_location_status,
            'lastseen' => $request->lastseen ]);

             // $deviceDetail= ClientList::update(['uniqueid' => $device_id],[]);
                if($deviceDetail){
                  return response()->json([
                  'success' => true,
                   'data'=> $deviceDetail,
                  'message' =>[ "CLient data Updated successfully."],
                  ], 200);
                  }
                    else{
                       return response()->json([
                    'success' => true,
                     'data'=> $deviceDetail,
                    'message' =>[ "Already Updated."],
                    ], 200);
                    }
              }else{
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
       public function check_device(Request $request){
         $device_id = $request->device_id;
        $device = ClientList::where('uniqueid','=',$device_id)->first();
           if($device){
     
           return response()->json([
                  'success' => true,
                   'message'=> ["Device Exist."],
                  ], 200);

              }else{
                // echo "else";exit();
                  return response()->json([
                  'success' => false,
                   'message'=> ["Device does't exist."],
                  ], 200);
              }
       }
  public function update_device_token(Request $request)
       {
          // dd($request->all());
          // $res = ClientList::where('uniqueid', $request->device_id)->get();
          // dd($res);

          $res = ClientList::where('uniqueid', $request->device_id)
          ->update(['device_token' => $request->device_token]);
        if($res ==1){
     
           return response()->json([
                  'success' => true,
                   'message'=> ["Device Token updated successfully."],
                  ], 200);

              }else{
                // echo "else";exit();
                  return response()->json([
                  'success' => false,
                   'message'=> ["Device does't exist."],
                  ], 200);
              }

       }

}
