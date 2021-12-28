<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use DB;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserGallery;
class UserGalleryController extends Controller
{
	public function photos(Request $request, $id)
	{		
		$clientlist = \App\ClientList::find($id);
		$request->session()->flash('device', $clientlist->id);
		$session = session()->get('device');
			$clientlists = UserGallery::where('device_id', $session)->get();
			$user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $session)->first();
			return view ('user.photos',compact('clientlists','session','user_id'));
	}
	public function displayImage($filename)

{



    $path = storage_path('app/public/user_galleries/' . $filename);



    if (!file_exists($path)) {

        return"Noting";

    }



    $file = file_get_contents($path);


    return response($file);

}
}
