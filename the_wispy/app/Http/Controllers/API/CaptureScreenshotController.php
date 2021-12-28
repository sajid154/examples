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

class CaptureScreenshotController extends BaseController
{

  public function submit_screenshot(Request $request)
  {
  	// return "ASa";

  	$device_id = str_replace('"', '', $request->device_id);
    return $this->saveCommands($request,'capture_screenshots');

 }

}
