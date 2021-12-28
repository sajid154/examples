<?php

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

Route::get('/', function () {
        return Redirect::to('login');
	//return view ('welcome');
});

Auth::routes();
	
	Route::group(['middleware' => ['auth']], function () {


Route::get('/home', 'HomeController@index')->name('home');	
Route::get('/devices', 'UserController@index');	
Route::get('/dashboard/{id}', 'UserController@show');
Route::get('{id}/device-settings', 'DeviceSettingController@index');
Route::post('device-settings', 'DeviceSettingController@store');

Route::get('/account/{id}/edit', 'UserController@edit');	
Route::post('/account/{id}/edit', 'UserController@update');	
// Route::get('{id}/calls', 'UserController@calls');	
Route::get('{id}/contacts', 'Dashboard\ContactsController@contacts');	
Route::get('{id}/sms', 'UserController@smses');	
// Route::get('{id}/photos', 'Dashboard\UserGalleryController@photos');	
Route::get('{id}/videos', 'Dashboard\VideosController@index');	
// Route::get('{id}/recordings', 'UserController@recording');	
Route::get('{id}/webhistory', 'Dashboard\WebHistoryController@default')->name('webhistory.default');	
Route::get('/superadmin', 'SuperAdminController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/admin/users', 'AdminController@users');
Route::get('/superadmin/users', 'SuperAdminController@users');
Route::get('/superadmin/users/{id}', 'SuperAdminController@show');
Route::get('/admin/users/{id}', 'AdminController@show');
Route::get('/superadmin/users/{id}/edit', 'SuperAdminController@edit');
Route::post('/superadmin/users/{id}/edit', 'SuperAdminController@update');
Route::get('/superadmin/users/{id}/delete', 'SuperAdminController@deleteUSer');
Route::get('/superadmin/add-new', 'SuperAdminController@addNewUser');
Route::post('/superadmin/add-new', 'SuperAdminController@store');
//////////////////////////
Route::post('displayalluserdevices', 'SuperAdminController@displayalluserdevices');

Route::get('/plans', 'PlanController@index');
Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');

//////////////////////////
Route::get('plansmanagement', 'SuperAdminController@showplans');
Route::get('addplan', 'SuperAdminController@addplan');
Route::post('storeplan', 'SuperAdminController@storeplan');
Route::get('editplan/{id}', 'SuperAdminController@viewplan');
Route::post('editplanstore/{id}', 'SuperAdminController@editplan');

/////////////////////////////////
Route::get('monthsmanagement', 'SuperAdminController@showmonths');
Route::get('addmonth', 'SuperAdminController@addmonth');
Route::post('storemonth', 'SuperAdminController@storemonth');
Route::get('editmonth/{id}', 'SuperAdminController@editmonth');
Route::post('editstoremonth/{id}', 'SuperAdminController@editstoremonth');
//features

Route::get('showfeaturelist', 'SuperAdminController@showfeaturelist');
Route::get('addfeature', 'SuperAdminController@addfeature');
Route::get('editfeature/{id}', 'SuperAdminController@editfeature');
Route::post('updatefeaturerecord', 'SuperAdminController@updatefeature');
Route::post('addnewfeature', 'SuperAdminController@addnewfeature');
//////////////////////////
Route::get('addplanfeature','SuperAdminController@addplanfeature');
Route::post('savefutureplan','SuperAdminController@savefutureplan');
Route::get('listfeatureplan','SuperAdminController@listplanfuture');
Route::get('editfeatureplan/{id}','SuperAdminController@editplanfuture');
Route::post('editplanfeatures','SuperAdminController@editplanfeatures');
Route::get('checkout/{id}','UserController@checkout');
//Route::get('addmonth', 'SuperAdminController@addmonth');


Route::get('payment', 'PaymentController@index');
Route::post('charge', 'PaymentController@charge');
Route::get('paymentsuccess', 'PaymentController@payment_success');
Route::get('paymenterror', 'PaymentController@payment_error');

Route::get('{id}/wifi-logger', 'Dashboard\WifiLoggerController@index');	
Route::get('wifilogger-default', 'Dashboard\WifiLoggerController@default')->name('wifilogger.default');

Route::get('{id}/photos', 'Dashboard\PhotosController@index');	
Route::get('photos-default', 'Dashboard\PhotosController@default')->name('photos.default');

Route::get('{id}/calendars', 'Dashboard\CalendarsController@index');	
Route::get('calendars-default', 'Dashboard\CalendarsController@default')->name('calendars.default');

Route::get('{id}/applications', 'Dashboard\ApplicationController@index');	
Route::get('applications-default', 'Dashboard\ApplicationController@default')->name('applications.default');

Route::get('{id}/videos', 'Dashboard\VideosController@index');	
Route::get('videos-default', 'Dashboard\VideosController@default')->name('videos.default');

Route::get('{id}/calls', 'Dashboard\CallLogsController@index');	
Route::get('calllogs-default', 'Dashboard\CallLogsController@default')->name('calllogs.default');

Route::get('{id}/locations', 'Dashboard\LocationsController@index');	
Route::get('locations-default', 'Dashboard\LocationsController@default')->name('locations.default');
Route::get('{id}/recordings', 'Dashboard\UserVoicesController@index');	
Route::get('voices-default', 'Dashboard\UserVoicesController@default')->name('voices.default');

Route::get('{id}/browsing-history', 'Dashboard\WebHistoryController@index');	
Route::get('browsing-history-default', 'Dashboard\WebHistoryController@default')->name('browsing-history.default');


Route::get('contacts-default', 'Dashboard\ContactsController@default')->name('contacts.default');
//Route::get('webhistory-default', 'Dashboard\WebHistoryController@default')->name('webhistory.default');

Route::get('storage/app/public/user_galleries/{filename}', 'Dashboard\UserGalleryController@displayImage')->name('image.displayImage');



//Clear configurations:
			Route::get('/config-clear', function() {
				$status = Artisan::call('config:clear');
				return '<h1>Configurations cleared</h1>';
			});

//Clear cache:
			Route::get('/cache-clear', function() {
				$status = Artisan::call('cache:clear');
				return '<h1>Cache cleared</h1>';
			});

//Clear configuration cache:
			Route::get('/config-cache', function() {
				$status = Artisan::call('config:cache');
				return '<h1>Configurations cache cleared</h1>';
			});
Route::get('/foo', function () {
Artisan::call('storage:link');
});



Route::post('send', 'MailController@send');

Route::get('create_paypal_plan', 'PaypalController@create_plan');
Route::get('/subscribe/paypal', 'PaypalController@paypalRedirect')->name('paypal.redirect');
Route::get('devices/return', 'PaypalController@paypalReturn')->name('paypal.return');

    //
Route::get('storage/user_galleries/{filename}', function ($filename)
{
    $path = storage_path('app/public/user_galleries/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
Route::get('storage/user_videos/{filename}', function ($filename)
{
    $path = storage_path('app/public/user_videos/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
Route::get('storage/user_voices/{filename}', function ($filename)
{
    $path = storage_path('app/public/user_voices/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
Route::get('storage/application_logo/{filename}', function ($filename)
{
    $path = storage_path('app/public/application_logo/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
Route::get('storage/user_document/{filename}', function ($filename)
{
    $path = storage_path('app/public/user_document/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});Route::get('storage/user_videos/{filename}', function ($filename)
{
    $path = storage_path('app/public/user_videos/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

});