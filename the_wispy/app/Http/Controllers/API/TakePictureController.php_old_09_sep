<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\UserGallery;
use App\Post;
use App\ClientList;
use Illuminate\Http\JsonResponse;
use date;

class TakePictureController extends BaseController
{

  public function take_pictures(Request $request)
  {
  	// return "ASa";
	 $device_id = str_replace('"', '', $request->device_id);
    return $this->saveCommands($request,'take_pictures');
 }

 public function store_user(Request $request)
  {
  	// return "ASa";
	Post::create([
		'title' => "ali raza",
		'content' => "aaaa",
		
	]);
	
 }

}
