<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use App\DevicePermissions;
use App\ClientList;

class DevicePermissionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function device_permissions(Request $request)
     {
          try {
        // dd($request->all());
        $result=array();
        
        $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

        if($device){
            foreach($request->device_permissions as $value){
                
            $value['device_id']= $device->id;
                $result=DevicePermissions::updateOrCreate(['name' => $value['name'], 'device_id' => $device->id],$value);

            }
            return $this->sendResponse($result, ['Device Permissions Inserted successfully']);
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

}