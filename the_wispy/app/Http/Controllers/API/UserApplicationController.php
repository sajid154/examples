<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\UserApplication;
use App\ClientList;


class UserApplicationController extends Controller
{
    public function userapplication(Request $request)
    {
// 
      // dd($request->all());
      //   return response()->json([
      //   'success' => true,
      //   'message' => $request->all(),
      // ], 200);
  try {
        
       $device_id = str_replace('"', '', stripslashes($request->device_id));

        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
      if($device){
     if($request->hasFile('application_logo')){
       for($i=0; $i < count($request->application_logo); $i++){
         // $filename = $request->application_logo[$i]->getClientOriginalName();

          $file = $request->application_logo[$i]->getClientOriginalName();
          $filename = pathinfo($file, PATHINFO_FILENAME);
          $extension = pathinfo($file, PATHINFO_EXTENSION);

          // if (!file_exists( storage_path() .'/app/public/application_logo/'. $filename.'_'.$device->id.'.'.$extension)) {
            
           $data['application_logo'] =     $request->application_logo[$i]->move(storage_path('/app/public/user_applications/'.$device->id),$filename.'_'.$device->id.'.'.$extension );

          $data['application_logo'] = $filename.'_'.$device->id.'.'.$extension; 

          $data['date_time']  = date("Y-m-d H:i:s", strtotime(str_replace('"', '', stripslashes($request->date_time[$i]))));
          $data['device_id'] = $device->id; 


          $data['application_name'] = str_replace('"', '', stripslashes($request->application_name[$i]));
          $data['application_package_name'] = str_replace('"', '', stripslashes($request->application_package_name[$i]));
          $data['application_time_usage'] = str_replace('"', '', stripslashes($request->application_time_usage[$i]));

		  // $result= UserApplication::create($data);
          $result=UserApplication::updateOrCreate(['application_logo' => $data['application_logo'], 'application_name' => $data['application_name'],'application_package_name' => $data['application_package_name'],'date_time' => $data['date_time'] ],$data);

          $message = 'User Application Data inserted successfully.';
        // }
        // else{
        //   $message = 'User Application Data already Exists.';
        // }
      }
      return response()->json([
        'success' => true,
        'message' => [$message],
      ], 200);
    }

        else{
            return response()->json([
        'success' => true,
        'message' => ["no file found"],
      ], 200);
    }
  }
  else{
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
