<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\UserVideos;
use App\ClientList;

class UserVideosController extends BaseController
{

  public function userVideos(Request $request)
  {
	  $device_id = str_replace('"', '', $request->device_id);
  	 return $this->saveLogs($request,'user_videos');
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_execution_time', 10000000);

    $result=array();
    $device_id = $request->device_id;
    $device = ClientList::where('uniqueid','=',"FFY5T17B08004999bcfafc1e09bb06ef")->first();

    if($request->hasFile('user_videos')){
      for($i=0; $i < count($request->user_videos); $i++){
        $filename = $request->user_videos[$i]->getClientOriginalName();
        if (!file_exists( storage_path() .'/app/public/userVideos/'. $filename)) {
          $data['path'] =     $request->user_videos[$i]->move(storage_path('/app/public/userVideos'), $request->user_videos[$i]->getClientOriginalName());

          $data['path'] = 'app/public/userVideos/'.$request->user_videos[$i]->getClientOriginalName(); 

          $data['date_time'] = date("Y-m-d", strtotime($request->date_time)); 
          $data['device_id'] = $device['id'];  
          $result[]= UserVideos::create($data);
          $message = 'User Videos inserted successfully.';

        }
        else{
          $message = 'User Videos already Exists.';
        }

      }
      return response()->json([
        'success' => true,
        'message' => $message,
      ], 200);
    }
  }
}
