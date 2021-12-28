<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use DataTables;
use App\UserApplication;
use File;
use Response;

class ValidateFileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkDeviceId:checkID');
    }


    public function validate_audio_files($folder_name, $par ,$filename)
    {
        $path = storage_path('app/public/' .$folder_name.'/'.$par.'/'. $filename);
        // dd($path);
    // return Image::make(storage_path('app/public/' .$folder_name.'/'.$par.'/'. $filename))->resize(250, 375)->response();


        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;

        }
 
 
}
