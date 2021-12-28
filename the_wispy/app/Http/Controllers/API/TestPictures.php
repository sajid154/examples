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

class TestPictures extends BaseController
{

  public function index(Request $request)
  {
  	      return response()->json([
        'success' => true,
        'message' => $request->all(),
      ], 200);

 }


}
