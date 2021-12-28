<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    
    public function saveGallery(Request $request)
     {
        echo "string";
     	// dd($request->image);
     	// dump($request->file('image'));
     	// $image = base64_encode(file_get_contents($request->file('image'))); 
     	// echo "string";
        // dump($image);

         $image = $request->image;  // your base64 encoded
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageName = str_random(10) . '.png';

    Storage::disk('local')->put($imageName, base64_decode($image));
    dd("saaa");
        dd(base64_decode($imagedata));
        $sms=array();
		$device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->first();
        if($device){
			foreach($request->user_logs as $value){
			$sms[]= SMS::create($value + ['device_id'=>$device->id]);
			}
        }
        return $this->sendResponse($sms, 'Sms inserted successfully');
     }
}
