<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;
use App\Models\Image;
use App\Models\Post;
use App\Models\Vidoe;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', function(){

    $user = User::find(1);

    // $role = new Role;
    // $role->name = 'Super Admin';


    // $user->roles()->save(('Intence'));
    // $user->roles()->create(['name'=>'CEO']);
});




Route::get('/roles', function(){

    $user = User::find(1);


    return $user->roles->where('id', 1);
});


Route::get('/add-car', function(){

    $user = User::find(1);


    // return $user->cars()->create(['name'=>"Honda City"]);
// $user->cars->where('id', 1);
     // dd($user->pivot);

//   
return $user->cars()->attach(5, ['is_turbo'=>1]);

});



Route::get('/cars', function(){

    $user = User::find(1);


    dd($user->cars);
});



Route::get('/morph-relations', function(){

    $user = User::find(1);

    // $user->image()->create(['url'=>'http://127.0.0.1:8000/registered-users#']);

   return $user->image;
});




Route::get('/check-image', function(){


    $con = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

    if(!$con){
        return "it didnt works";
    }

    $image = Image::find(1);

    // return $image->imageable;


    $closeDb = $con->close();

    if($closeDb){
        return "it works";
    }


});



Route::get('/morph-many', function(){

    $post = Post::find(1);

   return $post->comments;
    // $post->comments()->create(['body'=>'Post Comment']);

   // return $user->image;

    // $vidoe = Vidoe::find(1);

    // $vidoe->comments()->create(['body'=>'Vidoe Comment']);

});




Route::get('/morph-many-many', function(){

    $post = Post::find(1);

    return $post->tags()->create(['name'=>'Php']);

});

