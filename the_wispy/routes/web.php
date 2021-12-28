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
use App\TraficLogs;

Route::get('/test', function () {


dd(phpinfo());
});


Route::get('remove-device/{id?}', function ($id) {
    
    $exitCode = Artisan::call('command:RemoveExpiredFilesScheduler',['device_id'=>$id]);
        dump("Deleted Successfully");
    //
});


Route::get('/phpfirebase_sdk','FirebaseController@index');


Route::get('/remote-lock/{device_id}','FirebaseController@gotoLock');
Route::post('/remote-lock/{device_id}','FirebaseController@deviceRemoteLock');
Route::get('check_user', 'CheckUserLogin@check_user')->middleware('auth'); 
Auth::routes();
Route::get('/', function () { 
                                                                                                                                                                                                                                 
        if(request()->ref_code){

                $ip = request()->server()["REMOTE_ADDR"];


    $api_key = 'at_gUAVK4ZzYqJGKW5dRvpDk57auJewI';
    $api_url = 'https://geo.ipify.org/api/v1';

    $url = "{$api_url}?apiKey={$api_key}&ipAddress={$ip}";

   $ipLocation = json_decode(file_get_contents($url));

   // dd($ipLocation->location);
                                             
                    TraficLogs::create([
                        'ip_address'=>$ip, 
                        'country'=>$ipLocation->location->city .', '. $ipLocation->location->country,
                        'ref_code'=>request()->ref_code,
                        'ref_url'=> request()->server()['HTTP_HOST']
                    ]);

                session()->put('ref_code', request()->ref_code);
            
            return redirect('/register');

        }
    


        return Redirect::to('login');
    //return view ('welcome');
});


/*========================= Affiliate System =================================*/

Route::get('/affiliate-signup', function () {
        
    return view('agent.signup');
});
Route::get('/affiliate-login', function () {
        
    return view('agent.agent_login');
});
Route::post('/affiliate-signup', 'Affiliat\RagisterController@store')->name('affiliate-register');


Route::group(['middleware'=>['auth', 'affiliate_user']], function(){

        Route::get('/affiliate', 'Affiliat\HomeController@index')->name('affiliate-home');
        Route::get('/affiliate/customers', 'Affiliat\CustomersController@index')->name('affiliate-customers');
        Route::get('/affiliate/logs', 'Affiliat\HomeController@logs')->name('affiliate-logs');
        Route::get('/affiliate/commissions', 'Affiliat\HomeController@commissions')->name('affiliate-commissions');
        Route::get('/affiliate/edit-profile', 'Affiliat\HomeController@getProfile')->name('affiliate-edit');
        Route::get('/affiliate/messages', 'Affiliat\HomeController@getMessages')->name('affiliate-messages');
        Route::put('/affiliate/update-profile', 'Affiliat\HomeController@updateProfile')->name('affiliate-update');
        Route::post('/affiliate/messages', 'Affiliat\HomeController@saveMessage')->name('affiliate-save-messages');

});





Route::group(['middleware'=>['auth', 'digital']], function(){

        Route::get('/marketing', 'DigitalMarketing\HomeController@index')->name('market-home');
        Route::get('/market/agents', 'DigitalMarketing\HomeController@getAgents')->name('market-agents');
        Route::get('/market/messages', 'DigitalMarketing\HomeController@getAgentsMessages')->name('market-messages');
        Route::patch('market/agent-approve/{id}', 'DigitalMarketing\HomeController@agentApprove');
        Route::patch('market/agent-un-approve/{id}', 'DigitalMarketing\HomeController@agentDisapprove');
        Route::get('/market/edit-profile', 'DigitalMarketing\HomeController@getProfile')->name('market-edit');
        Route::get('/market/agent/{ref_code}/customers', 'DigitalMarketing\HomeController@getAgentCustomers')->name('market-agent-customers');
        Route::put('/market/update-profile', 'DigitalMarketing\HomeController@updateProfile')->name('market-update');
        Route::get('/market/messages/{agent_id}', 'DigitalMarketing\HomeController@getMessages')->name('market-agent-messages');
        Route::post('/market/messages/{agent_id}', 'DigitalMarketing\HomeController@saveMessage')->name('market-save-messages');


});



/* =================================================================================== */
    
  Route::get('check-device-models', function () {
    dump("Dfdf");


$res = DB::select('SELECT clientlist.id AS c_id, user_id, manufacturer, modal, android_os,

COUNT(calllog.`id`) AS calllog, 
COUNT(`contacts`.`id`) AS `contacts`,
COUNT(`wifi_loggers`.`id`) AS `wifi_loggers`,
COUNT(`user_voices`.`id`) AS `user_voices`,
COUNT(`user_videos`.`id`) AS `user_videos`,
COUNT(`user_galleries`.`id`) AS `user_galleries`,
COUNT(`user_applications`.`id`) AS `user_applications`


FROM clientlist
 
LEFT JOIN `calllog` ON clientlist.`id` = `calllog`.device_id
LEFT JOIN `contacts` ON clientlist.`id` = `contacts`.device_id
LEFT JOIN `wifi_loggers` ON clientlist.`id` = `wifi_loggers`.device_id
LEFT JOIN `user_voices` ON clientlist.`id` = `user_voices`.device_id
LEFT JOIN `user_videos` ON clientlist.`id` = `user_videos`.device_id
LEFT JOIN `user_galleries` ON clientlist.`id` = `user_galleries`.device_id
LEFT JOIN `user_applications` ON clientlist.`id` = `user_applications`.device_id

WHERE manufacturer = "samsung" AND device_status ="active" AND clientlist.id = 616

GROUP BY clientlist.id ORDER BY modal');
        dd($res);
});     


  Route::get('check-device-models2', function () {
    dump("Dfdf");
    
         $res = DB::select('SELECT clientlist.id AS c_id,user_id,manufacturer,modal,android_os,
COUNT(calllog.`id`) AS calllog, 
COUNT(`contacts`.`id`) AS `contacts`,
COUNT(`wifi_loggers`.`id`) AS `wifi_loggers`,
COUNT(`user_videos`.`id`) AS `user_videos`,
COUNT(`user_applications`.`id`) AS `user_applications`

FROM clientlist
 
LEFT JOIN `calllog` ON clientlist.`id` = `calllog`.device_id
LEFT JOIN `contacts` ON clientlist.`id` = `contacts`.device_id
LEFT JOIN `wifi_loggers` ON clientlist.`id` = `wifi_loggers`.device_id
LEFT JOIN `user_videos` ON clientlist.`id` = `user_videos`.device_id
LEFT JOIN `user_applications` ON clientlist.`id` = `user_applications`.device_id


WHERE manufacturer = "samsung" AND device_status ="active" AND clientlist.id = 616

GROUP BY clientlist.id ORDER BY modal');
        dd($res);
});     



Route::get('demo-login-user', 'Reports\RegisteredUsersControllers@demo_login_user')->middleware('cors');
Route::group(['middleware' => ['auth', 'guest']], function () {
    Route::get('/devices', 'UserController@index'); 
    // Route::get('/devices', function(){
    //     return Auth::user();
    // }); 

    Route::get('/commissions', 'SettingController@commissions')->name('commissions-index');
    Route::get('/commissions-history/{agent_id}', 'SettingController@getAgentPaymentHistory')->name('commissions-history');
    Route::get('/commissions-history/{agent_id}/pay/{pay_id}', 'SettingController@getAgentPaymentPay')->name('commissions-pay');
    Route::get('/commissions/{id}', 'SettingController@getCommission')->name('edit-commission');
    Route::put('/commissions/{id}/update', 'SettingController@updateCommission')->name('update-commission');

    Route::post('/commissions/pay-paypal', 'SettingController@payCommissionPaypal')->name('pay-via-paypal');

    Route::post('/commissions/pay-bank', 'SettingController@payCommissionBank')->name('pay-via-bank');

    Route::post('/secure-payment', 'StripePaymentController@scaPay');
    Route::post('/payment-process', 'StripePaymentController@paymentProcess'); 
    Route::get('/device/{id?}', 'UserController@check_inactive_devices'); 
    Route::get('/home', 'HomeController@index')->name('home');  
    Route::get('/plans', 'PlanController@index');
    Route::post('device-settings', 'DeviceSettingController@store');
    Route::post('change-subscription', 'DeviceSettingController@unsubscribe');
    Route::post('charge-difference', 'PaymentController@charge_difference');
    

    
    Route::get('/account/{id}/edit', 'UserController@edit');    
    Route::post('/account/{id}/edit', 'UserController@update'); 

    Route::get('/superadmin', 'SuperAdminController@index');
    Route::get('agent-users', 'Reports\RegisteredUsersControllers@getAgents');
    
    Route::patch('agent-approve/{id}', 'Reports\RegisteredUsersControllers@agentApprove');
    Route::patch('agent-un-approve/{id}', 'Reports\RegisteredUsersControllers@agentDisapprove');
    Route::patch('agent-active/{id}', 'Reports\RegisteredUsersControllers@agentActivate');
    Route::patch('agent-un-active/{id}', 'Reports\RegisteredUsersControllers@agentDeactivate');



    Route::get('registered-users', 'Reports\RegisteredUsersControllers@index');
    Route::get('auto-login-user/{id?}', 'Reports\RegisteredUsersControllers@auto_login_user');
    Route::get('registered-users-default', 'Reports\RegisteredUsersControllers@default');
    Route::post('registered-users-search', 'Reports\RegisteredUsersControllers@mySearch');
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


    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');

    //////////////////////////
    Route::get('plansmanagement', 'SuperAdminController@showplans');
    Route::get('addplan', 'SuperAdminController@addplan');
    Route::post('storeplan', 'SuperAdminController@storeplan');
    Route::get('editplan/{id}', 'SuperAdminController@viewplan');
    Route::post('editplanstore/{id}', 'SuperAdminController@editplan');
	Route::get('/user/verify/{token}', 'UserController@verifyUser');
    Route::get('/verification/user/email','UserController@SendVerifyEmail');



    // Admin Coupon Routes
    Route::match(['get','post'],'/superadmin/add-coupon','CouponsController@addCoupon');
    Route::match(['get','post'],'/superadmin/edit-coupon/{id}','CouponsController@editCoupon');
    Route::get('/superadmin/view-coupons','CouponsController@viewCoupons');
    Route::get('/superadmin/delete-coupon/{id}','CouponsController@deleteCoupon');
    
    Route::post('/apply-coupon','CouponsController@applyCoupon');

        /*End*/

    // Admin email-templates
    Route::match(['get','post'],'/superadmin/add-email-template','EmailTemplateController@addTemplate');
    Route::match(['get','post'],'/superadmin/edit-email-template/{id}','EmailTemplateController@editTemplate');
    Route::get('/superadmin/view-email-templates','EmailTemplateController@viewTemplates');
    Route::get('/superadmin/delete-email-template/{id}','EmailTemplateController@deleteTemplate');
    
    Route::post('/email-templates','EmailTemplateController@applyTemplate');




    // Emails Section
    Route::get('report-by-all-users', 'Reports\ReportByAllUsersControllers@index');
    Route::get('report-by-all-users-default', 'Reports\ReportByAllUsersControllers@default');




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
    Route::get('checkout','UserController@checkout');
    Route::post('checkout','UserController@checkout');
	Route::post('trial/version/user','PaymentController@trialVersionUSer');
    //Route::get('addmonth', 'SuperAdminController@addmonth');


    Route::get('payment', 'PaymentController@index');
    Route::post('charge', 'PaymentController@charge');
	Route::post('stripecharge', 'StripePaymentController@pay');
    Route::get('thanks', 'PaymentController@thankYou');
    Route::post('trail','PaymentController@trail');
    Route::get('paymentsuccess', 'PaymentController@payment_success');
    Route::get('paymenterror', 'PaymentController@payment_error');
    Route::post('plan-renewal', 'PaymentController@plan_renewal');
	Route::post('charge_card', 'PaymentController@charge_creditcard');
	Route::get('setup-wizard-1/{id?}', 'UserController@setup_wizard_one');
	Route::get('setup-wizard-2/{id?}', 'UserController@setup_wizard_two');
	Route::get('setup-wizard-3/{id?}', 'UserController@setup_wizard_three');

    Route::post('send', 'MailController@send');

    Route::get('create_paypal_plan', 'PaypalController@create_plan');
    Route::get('/subscribe/paypal', 'PaypalController@paypalRedirect')->name('paypal.redirect');
    Route::get('devices/return', 'PaypalController@paypalReturn')->name('paypal.return');


Route::get('files/{user_galleries}/{par}/{filename}','Dashboard\ValidateFileController@validate_audio_files');

    // Route::get('storage/user_galleries/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/user_galleries/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });
    // Route::get('storage/user_videos/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/user_videos/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });
    // Route::get('storage/user_voices/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/user_voices/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });
    // Route::get('storage/application_logo/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/application_logo/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });
    // Route::get('storage/user_document/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/user_document/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });Route::get('storage/user_videos/{filename}', function ($filename)
    // {
    //     $path = storage_path('app/public/user_videos/' . $filename);
    //     if (!File::exists($path)) {
    //         abort(404);
    //     }
    //     $file = File::get($path);
    //     $type = File::mimeType($path);
    //     $response = Response::make($file, 200);
    //     $response->header("Content-Type", $type);
    //     return $response;
    // });

  
   
// Route::get('capture-screenshot-default/{id?}', 'Dashboard\CaptureScreenshotController@default');
	Route::get('last-sync/{id?}','Dashboard\RecordAudioController@run_command_sync');
// Route::post('run-command-screenshot/{id?}','Dashboard\CaptureScreenshotController@run_command');

// Route::get('record-video/{id}', 'Dashboard\RecordVideoController@index');
// Route::get('record-video-default/{id?}', 'Dashboard\RecordVideoController@default');
// Route::post('run-command-video/{id?}','Dashboard\RecordVideoController@run_command');

// Route::get('record-audio/{id}', 'Dashboard\RecordAudioController@index');
// Route::get('record-audio-default/{id?}', 'Dashboard\RecordAudioController@default');
// Route::post('run-command-audio/{id?}','Dashboard\RecordAudioController@run_command');


// Route::get('capture-screenshot/{id}', 'Dashboard\CaptureScreenshotController@index')->name('capture-screenshot');
// Route::get('capture-screenshot-default/{id?}', 'Dashboard\CaptureScreenshotController@default');
// Route::post('run-command-screenshot/{id?}','Dashboard\CaptureScreenshotController@run_command');


// Route::get('take-picture/{id}', 'Dashboard\TakePictureController@index');
// Route::get('take-picture-default/{id?}', 'Dashboard\TakePictureController@default');
// Route::post('run-command-to-take-picture/{id?}','Dashboard\TakePictureController@run_command');


// Route::get('screen-recording/{id}', 'Dashboard\RecordScreenController@index');
// Route::get('screen-recording-default/{id?}', 'Dashboard\RecordScreenController@default');
// Route::post('run-command-to-record-screen/{id?}','Dashboard\RecordScreenController@run_command');


// Route::get('record-video/{id}', 'Dashboard\RecordVideoController@index');
// Route::get('record-video-default/{id?}', 'Dashboard\RecordVideoController@default');
// Route::post('run-command-to-take-video/{id?}','Dashboard\RecordVideoController@run_command');


// Route::get('record-audio/{id}', 'Dashboard\RecordAudioController@index');
// Route::get('record-audio-default/{id?}', 'Dashboard\RecordAudioController@default');
// Route::post('run-command-audio/{id?}','Dashboard\RecordAudioController@run_command');

// Route::post('get-user-devices/{id?}','SuperAdminController@get_user_devices');
// Route::get('user-device-stats/{id?}', 'SuperAdminController@user_device_stats');


Route::get('capture-screenshot-default/{id?}', 'Dashboard\CaptureScreenshotController@default');
Route::post('run-command-screenshot/{id?}','Dashboard\CaptureScreenshotController@run_command');



Route::get('take-picture-default/{id?}', 'Dashboard\TakePictureController@default');
Route::post('run-command-to-take-picture/{id?}','Dashboard\TakePictureController@run_command');



Route::get('screen-recording-default/{id?}', 'Dashboard\RecordScreenController@default');
Route::post('run-command-to-record-screen/{id?}','Dashboard\RecordScreenController@run_command');



Route::get('record-video-default/{id?}', 'Dashboard\RecordVideoController@default');
Route::post('run-command-to-take-video/{id?}','Dashboard\RecordVideoController@run_command');



Route::get('record-audio-default/{id?}', 'Dashboard\RecordAudioController@default');
Route::post('run-command-audio/{id?}','Dashboard\RecordAudioController@run_command');

Route::post('get-user-devices/{id?}','SuperAdminController@get_user_devices');
Route::get('user-device-stats/{id?}', 'SuperAdminController@user_device_stats');

    Route::post('call-block-add', 'Dashboard\CallBlockController@store');
    Route::delete('call-block/{id}', 'Dashboard\CallBlockController@destroy');
    Route::get('call-block-incoming/{id}', 'Dashboard\CallBlockController@incoming');
    Route::delete('call-block-incoming-delete/{id}', 'Dashboard\CallBlockController@incoming_delete');

    Route::delete('whatsapp-sms/{id}', 'Dashboard\WhatsappController@destroy');
    Route::delete('browser-history/{id}', 'Dashboard\BrowserHistoryController@destroy');

    Route::delete('keyword-alert/{id}', 'Dashboard\KeywordsController@destroy');
    Route::post('keyword-alert-add', 'Dashboard\KeywordsController@store');
    Route::get('keyword-alert-history/{id}', 'Dashboard\KeywordsController@searched_keywords');
    Route::delete('keyword-alert-history/{id}', 'Dashboard\KeywordsController@searched_keywords_destroy');
    Route::delete('remove-geo-fence/{id}', 'Dashboard\GeoFenceController@destroy');
    Route::delete('remove-geo-fence-logs/{id}', 'Dashboard\GeoFenceController@removeLog');
    Route::delete('remove-gmail/{id}', 'Dashboard\GmailController@destroy');
    Route::get('add-geo-fence/{id?}', 'Dashboard\GeoFenceController@add');

});

Route::group(['middleware' => ['auth','checkDeviceId','cors']], function () {


    Route::get('call-block/{id}', 'Dashboard\CallBlockController@index');
    Route::get('call-block-add/{id}', 'Dashboard\CallBlockController@create');    
    Route::get('whatsapp-sms/{id}', 'Dashboard\WhatsappController@index');
    Route::get('viber-sms/{id}', 'Dashboard\ViberController@index');
    Route::get('instagram-sms/{id}', 'Dashboard\InstagramController@index');
    Route::get('browser-history/{id}', 'Dashboard\BrowserHistoryController@index');
    Route::get('keywords-alert/{id}', 'Dashboard\KeywordsController@index');
    Route::get('geo-fence-logs/{id?}', 'Dashboard\GeoFenceController@incomingLogs'); 
    Route::get('keyword-alert-add/{id}', 'Dashboard\KeywordsController@create');
    Route::get('gmail-email/{id}', 'Dashboard\GmailController@index');

    Route::get('facebook-messanger/{id}', 'Dashboard\MessangerController@index');
    Route::get('snapchat-messages/{id}', 'Dashboard\SnapchatController@index');

    Route::get('/dashboard/{id}', 'UserController@show');
    
    Route::get('wifilogger-default/{id?}', 'Dashboard\WifiLoggerController@default');
    Route::get('photos-default/{id?}', 'Dashboard\PhotosController@default');
    Route::get('calendars-default/{id?}', 'Dashboard\CalendarsController@default');
    Route::get('applications-default/{id?}', 'Dashboard\ApplicationController@default');
    Route::get('sms-default/{id?}', 'Dashboard\SmsController@default');
    Route::get('videos-default/{id?}', 'Dashboard\VideosController@default');
	Route::get('voices-default/{id?}', 'Dashboard\UserVoicesController@default');
    Route::get('calllogs-default/{id?}', 'Dashboard\CallLogsController@default');
    
    Route::get('call-recordings-default/{id?}','Dashboard\CallRecordingsController@default');

    Route::get('locations-default/{id?}', 'Dashboard\LocationsController@default');
    Route::post('geo-tracking-default/{id?}', 'Dashboard\GeoTrackingController@default');
    Route::post('geo-fence-default/{id?}', 'Dashboard\GeoFenceController@default');
    Route::post('geo-fence/{id?}', 'Dashboard\GeoFenceController@store');
    Route::get('browsing-history-default/{id?}', 'Dashboard\WebHistoryController@default');
    Route::get('contacts-default/{id?}', 'Dashboard\ContactsController@default');

    
    Route::get('/plans/{id}', 'UserController@plans');
    Route::get('device-settings/{id}', 'DeviceSettingController@index');
    Route::get('unsubscribe/{id}', 'DeviceSettingController@unsubscribe');

    Route::group(['middleware' => ['checkEndDate']], function () {

// Route::get('recordings/{id}', 'Dashboard\UserUserVoicesController@index');  
// Route::get('voices-default/{id?}', 'Dashboard\UserUserVoicesController@default');
// Route::get('/dashboard/{id}', 'UserController@show');


    
    Route::get('contacts/{id}', 'Dashboard\ContactsController@contacts');   
    Route::get('webhistory/{id}', 'Dashboard\WebHistoryController@default')->name('webhistory.default');    
Route::get('wifi-logger/{id}', 'Dashboard\WifiLoggerController@index'); 
Route::get('photos/{id}', 'Dashboard\PhotosController@index');  
Route::get('calendars/{id}', 'Dashboard\CalendarsController@index');    
Route::get('applications/{id}', 'Dashboard\ApplicationController@index');   
Route::get('sms/{id}', 'Dashboard\SmsController@index');  
Route::get('videos/{id}', 'Dashboard\VideosController@index');  
Route::get('voices/{id}', 'Dashboard\UserVoicesController@index'); 
Route::get('calls/{id}', 'Dashboard\CallLogsController@index'); 
Route::get('call-recordings/{id}', 'Dashboard\CallRecordingsController@index');
Route::get('locations/{id}', 'Dashboard\LocationsController@index');
Route::get('geo-tracking/{id}', 'Dashboard\GeoTrackingController@index');

Route::get('browsing-history/{id}', 'Dashboard\WebHistoryController@index');
Route::get('capture-screenshot/{id}', 'Dashboard\CaptureScreenshotController@index')->name('capture-screenshot');
Route::get('take-picture/{id}', 'Dashboard\TakePictureController@index');
Route::get('screen-recording/{id}', 'Dashboard\RecordScreenController@index');
Route::get('record-video/{id}', 'Dashboard\RecordVideoController@index');
Route::get('record-audio/{id}', 'Dashboard\RecordAudioController@index');
    
    });
});

Route::get('sms/{id}', 'Dashboard\SmsController@index');  
    
    Route::get('geo-track/{id?}', 'Dashboard\GeoTracking@index');    
    Route::get('geo-fence/{id?}', 'Dashboard\GeoFenceController@index');    
    Route::get('snapchat-default/{contact_name?}', 'Dashboard\SnapchatController@default');
    Route::get('whatsapp-default/{contact_name?}', 'Dashboard\WhatsappController@default');
    Route::get('viber-default/{contact_name?}', 'Dashboard\ViberController@default');
    Route::get('instagram-default/{contact_name?}', 'Dashboard\instagramController@default');
    Route::get('messanger-default/{contact_name?}', 'Dashboard\MessangerController@default');
    
    Route::get('gmail-email-default/{id?}', 'Dashboard\GmailController@default');
    Route::get('gmail-email-find/{id?}', 'Dashboard\GmailController@searchMail');
    Route::post('search-gmail/{id?}', 'Dashboard\GmailController@filter');
    
    
    

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    return "Cache is cleared";
});

