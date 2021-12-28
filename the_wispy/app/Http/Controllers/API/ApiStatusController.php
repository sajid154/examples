<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use App\ApiStatus;
use App\ClientList;

class ApiStatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function api_status(Request $request)
     {
        // dd($request->all());
        $sms=array();
        
        $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

        if($device){
            // foreach($request->api_status as $value){
                
            $request['device_id']= $device->id;
                $result=ApiStatus::Create($request->all());

            // }
            return $this->sendResponse($sms, ['Api Status Inserted successfully in '. $request->api_name ]);
        }else{
                // echo "else";exit();
                  return response()->json([
                  'success' => false,
                   'message'=> ["Device does't exist."],
                  ], 200);
              }
        
     }

}