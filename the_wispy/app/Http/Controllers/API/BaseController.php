<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\UserGallery;
use App\RecordAudio;
use App\ClientList;
use App\CaptureScreenshot;
use DB;
use Illuminate\Support\Facades\Session;
class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
        'success' => true,
        // 'data'=> $result,
        'message' => $message,
        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
        'success' => false,
        'message' => $error,
        ];
        if(!empty($errorMessages))
        {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function saveLogs($request,$UserLogs)
  {

      // return response()->json([
      //   'success' => true,
      //   'message' => $request->all(),
      // ], 200);
          try {

    ini_set('max_file_uploads', 200);
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_input_time', '60');

    ini_set('max_execution_time', 600);

    $result=array();
    $device_id = str_replace('"', '', $request->device_id);
    $device = ClientList::where('uniqueid','=',"$device_id")->where('device_status','active')->first();
    // return ;
    // echo "string";
    // return $device;
if($device){

    if($request->hasFile($UserLogs)){
        // dd($UserLogs);
      for($i=0; $i < count($request->$UserLogs); $i++){
        // $filename = $request->$UserLogs[$i]->getClientOriginalName();

        $file = $request->$UserLogs[$i]->getClientOriginalName();

          $filename = pathinfo($file, PATHINFO_FILENAME);
          $extension = pathinfo($file, PATHINFO_EXTENSION);
        if (!file_exists( storage_path() ."/app/public/$UserLogs/".$device->id.'/'. $filename.'_'.$device->id.'.'.$extension)) {



          $data['path'] = $request->$UserLogs[$i]->move(storage_path("/app/public/$UserLogs/".$device->id),$filename.'_'.$device->id.'.'.$extension );

          $data['path'] = $filename.'_'.$device->id.'.'.$extension; 

          $data['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', stripslashes($request->date_time[$i])))); 
          // dd($data);
          $data['device_id'] = $device->id;  
          $data['created_at'] = date("Y-m-d h:i:s");  
          $data['updated_at'] = date("Y-m-d h:i:s");  
          // CaptureScreenshot::create($data);
          $result[]= DB::table($UserLogs)->insert($data);
          $message = strtoupper(str_replace('_',' ',$UserLogs)).' inserted successfully.';
          // return redirect('capture-screenshot'.'/'.$device->id);
        }
        else{
          $message = strtoupper(str_replace('_',' ',$UserLogs)).' already Exists.';
        }

      }
      return response()->json([
        'success' => true,
        'message' =>[ $message],
      ], 200);
    }
  }else{
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
  public function saveCommands($request,$UserLogs)
  {

  try {

    ini_set('max_file_uploads', 200);
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_execution_time', 10000000);

    $result=array();
    $device_id = str_replace('"', '', stripslashes($request->device_id));
    $device_state = str_replace('"', '', stripslashes($request->device_state));
    $device = ClientList::where('uniqueid','=',"$device_id")->where('device_status','active')->first();
    // return ;
    // echo "string";
    // dd($request->all());
    // return $device;
if($device){

        if($request->hasFile($UserLogs)){
            // dd($UserLogs);
          // for($i=0; $i < count($request->$UserLogs); $i++){
            // $filename = $request->$UserLogs[$i]->getClientOriginalName();

            $file = $request->$UserLogs->getClientOriginalName();

              $filename = pathinfo($file, PATHINFO_FILENAME);
              $extension = pathinfo($file, PATHINFO_EXTENSION);
            // if (!file_exists( storage_path() ."/app/public/$UserLogs/". $filename.'_'.$device->id.'.'.$extension)) {



              $data['path'] = $request->$UserLogs->move(storage_path("/app/public/$UserLogs/".$device->id),$filename.'_'.date("Y_m_d_h_i_s").'_'.$device->id.'.'.$extension );

              $data['path'] = $filename.'_'.date("Y_m_d_h_i_s").'_'.$device->id.'.'.$extension; 

              $data['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', stripslashes($request->date_time)))); 
              $data['device_id'] = $device->id;  
              $data['device_state'] = $device_state;  
              $data['created_at'] = date("Y-m-d h:i:s");  
              $data['updated_at'] = date("Y-m-d h:i:s");  
              // RecordAudio::create($data);
               // return $data;
              $result[]= DB::table($UserLogs)->insert($data);

              // DB::insert( DB::raw( "CREATE TEMPORARY TABLE tempproducts") );



              $data['type'] =  $UserLogs; 
              DB::table('command_temp_table')->insert($data);
              
              // Session::put('device_id', $device->id);

              // $value = Session::get('device_id');
              $message = strtoupper(str_replace('_',' ',$UserLogs)).' inserted successfully.';
              // return redirect('capture-screenshot'.'/'.$device->id);
            // }
            // else{
            //   $message = strtoupper(str_replace('_',' ',$UserLogs)).' already Exists.';
            // }

          // }
          return response()->json([
            'success' => true,
            'message' => [$message],
          ], 200);
        }

        else{

              $data['date_time'] = date("Y-m-d H:i:s", strtotime(str_replace('"', '', stripslashes($request->date_time)))); 
              $data['device_id'] = $device->id;  
              $data['device_state'] = $device_state;  
              $data['created_at'] = date("Y-m-d h:i:s");  
              $data['updated_at'] = date("Y-m-d h:i:s");  

              $data['type'] =  $request->type; 
              DB::table('command_temp_table')->insert($data);
              
              $message = 'Data Inserted Successfully.';
     
              return response()->json([
                'success' => true,
                'message' => [$message],
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