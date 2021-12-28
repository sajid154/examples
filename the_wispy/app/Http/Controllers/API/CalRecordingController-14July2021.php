<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use App\ClientList;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use App\Call;
use App\CallRecordings;
use Carbon\Carbon;

class CalRecordingController extends BaseController
{
   
    public function save_call_recordings(Request $request)
    {
            // dd($request->all());
          try {
   $device_id = str_replace('"', '', stripslashes($request->device_id));
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
      if($device){
     if($request->hasFile('call_recordings')){
       for($i=0; $i < count($request->call_recordings); $i++){
         // $filename = $request->call_recordings[$i]->getClientOriginalName();

          $file = $request->call_recordings[$i]->getClientOriginalName();
          $filename = pathinfo($file, PATHINFO_FILENAME);
          $extension = pathinfo($file, PATHINFO_EXTENSION);

          if (!file_exists( storage_path() .'/app/public/call_recordings/'. $filename.'_'.$device->id.'.'.$extension)) {
            
           $data['call_recordings'] =     $request->call_recordings[$i]->move(storage_path('/app/public/call_recordings/'.$device->id),$filename.'_'.$device->id.'.'.$extension );

          $data['call_recordings'] = $filename.'_'.$device->id.'.'.$extension; 

          $data['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', stripslashes($request->date_time[$i])))); 
          
 
          $data['device_id'] = $device->id; 

          $data['number'] = str_replace('"', '', stripslashes($request->number[$i]));
          $data['type'] = str_replace('"', '', stripslashes($request->type[$i]));
          $data['duration'] = str_replace('"', '', stripslashes($request->duration[$i]));
          $data['name'] = "ok";

      // $result= UserApplication::create($data);
          $result=CallRecordings::updateOrCreate(['path' => $data['call_recordings'], 'number' => $data['number'],'duration' => $data['duration'],'type' => $data['type'],'name' => $data['name'],'date_time' => $data['date_time'] ],$data);

          $message = 'Call Recordings Data inserted successfully.';
        }
        else{
          $message = 'Call Recordings Data already Exists.';
        }
      }
          return response()->json([
            'success' => true,
            'message' =>[ $message],
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


