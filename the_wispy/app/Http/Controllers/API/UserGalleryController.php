<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\UserGallery;
use App\ClientList;
use Illuminate\Http\JsonResponse;
class UserGalleryController extends BaseController
{

  public function userImages(Request $request)
  {
  	// // return "ASa";
	$device_id = str_replace('"', '', $request->device_id);
    return $this->saveLogs($request,'user_galleries');
    ini_set('memory_limit','10240M');
    ini_set('post_max_size', '200M');
    ini_set('max_execution_time', 10000000);
    ini_set('max_file_uploads', 200);

    $result=array();
    $device_id = $request->device_id;
    $device = ClientList::where('uniqueid','=',"FFY5T17B08004999bcfafc1e09bb06ef")->first();

    if($request->hasFile('user_images')){
      for($i=0; $i < count($request->user_images); $i++){
        $filename = $request->user_images[$i]->getClientOriginalName();
        if (!file_exists( storage_path() .'/app/public/userImages/'. $filename)) {
          $data['images_path'] =     $request->user_images[$i]->move(storage_path('/app/public/userImages'), $request->user_images[$i]->getClientOriginalName());

          $data['images_path'] = 'app/public/userImages/'.$request->user_images[$i]->getClientOriginalName(); 

          $data['date_time'] = date("Y-m-d", strtotime($request->date_time)); 
          $data['device_id'] = $device['id'];  
          $result[]= UserGallery::create($data);
          $message = 'User Images inserted successfully.';

        }
        else{
          $message = 'User Images already Exists.';
        }

      }
      return response()->json([
        'success' => true,
        'message' => $message,
      ], 200);
    }
    else{
       return response()->json([
        'success' => true,
        'message' => "Please select images.",
      ], 200);
    }
  }
}
