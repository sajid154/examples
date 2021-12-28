<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\ClientList;
use App\UserDocument;

class UserDocumentController extends Controller
{
    public function user_dacument(Request $request)
    {
	  $device_id = str_replace('"', '', $request->device_id);

	 $device = ClientList::where('uniqueid','=',$device_id)->where('device_status','active')->first();
         if($device){
        if($request->hasFile('user_document')){
        for($i=0; $i < count($request->user_document); $i++){

        $file = $request->user_document[$i]->getClientOriginalName();
          $filename = pathinfo($file, PATHINFO_FILENAME);
          $extension = pathinfo($file, PATHINFO_EXTENSION);

       if (!file_exists( storage_path() .'/app/public/user_document/'. $filename.'_'.$device->id.'.'.$extension)) {
        $data['path'] = $request->user_document[$i]->move(storage_path('/app/public/user_document'),$filename.'_'.$device->id.'.'.$extension );

        $data['user_document'] = 'app/public/user_document/'.$filename.'_'.$device->id.'.'.$extension; 
        $data['modified_date'] = $request->modified_date[$i];
        $result= UserDocument::create($data);
        $message = 'User Documents inserted successfully.';

        }
        else{
          $message = 'User Documents already Exists.';
        }

      }
      return response()->json([
        'success' => true,
        'message' => $message,
      ], 200);
    }
  }
    else{
      // echo "else";exit();
        return response()->json([
        'success' => false,
         'message'=> "Device does't exist.",
        ], 404);
    }
  }
}
