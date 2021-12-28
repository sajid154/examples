<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use App\ClientList;
use DataTables;
use App\CaptureScreenshot;
use App\RecordVideo;
use App\CommandTemp;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Illuminate\Support\Facades\Session;
class RecordVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {   
        // return "$id";
        $clientlist = \App\ClientList::find($id);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
        // $clientlists = CaptureScreenshot::where('device_id', $session)->get();
         $device_id = $clientlist->id; 
        $plan_id = \App\ClientList::select('plan_id','plan_id as plan')->where('id', $id)->first();
        $user_id = \App\ClientList::select('user_id','user_id as user')->where('id', $id)->first();
        return view ('user.record_video',compact('device_id','plan_id','id','user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default(Request $request)
    {
        // $clientlist = \App\ClientList::find($request->log_value);
        // $request->session()->flash('device', $clientlist->id);
        // $session = session()->get('device');
        $data = RecordVideo::where('device_id', $request->device_id)->get();

        if ($request->ajax()) {

            return Datatables::of($data)
            ->editColumn('date_time_f', function ($data) {
            return date('g:i:s A', strtotime($data->date_time));
            })
            ->addColumn('intro', function ($data) {
                return date('M,d Y', strtotime($data->date_time));
            })
                    ->make(true);
        }
      
        return view('users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function run_command(Request $request, $id){
        // echo "Dfd";
        // dd($id);
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder();
        // $notificationBuilder->setBody('Hello world')
                            // ->setSound('default');
        $recording_time = explode('m', $request->recording_time);
        $recording_time = $recording_time[0];
        // dd($recording_time);
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['run_command' => 'record_video','recording_time' => $recording_time,'camera_type' => $request->camera_type ]);



        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // dump($token);
        // dump($option);
        // dump($notification);
        // dd($data);exit();
//$token = ClientList::where('id', $id)->pluck('device_token');
// $token = "e2FE00hfQ4SPHFlFrSDK2S:APA91bFOnZ58WwF1HS-wh-LHSLGI2D95uFv-3T7e1IaoKxvngBaRMNDePnbXnUjsnd3ACpn_kWYN2VRlNmuJ0Ij9L3BSG5mmQBT5XfY7y4BP4BtAy4sZQZY78zFacd4Av8W_31fRwUwo";
 $token = ClientList::where('id', $id)->select('device_token')->first();
            // dd($token);
            $token = $token->device_token;
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        // dd(response()->json($downstreamResponse, 200));
// // return response()->json(200, 'Sent', $downstreamResponse);
//            return response()->json( [
//                   'response' => $downstreamResponse
//                ] );
        // echo "string";
        // return $value = Session::get('device_id');
       // return $this->check_sess($id);
        
          // dd("value");

        // return 
        $res =  $downstreamResponse->numberSuccess();
        // dd($res);
        if($res == 1){

       $check_sess =   $this->check_sess($id);
 if($check_sess != null){
            $get_record = Session::get('device_id');
            //      echo "string";
            // dump($get_record);

            // dd($get_record);
            // return response()->json([
                // 'data' => $data]);
        
        $response = [
            'success' => true,
            'data' => $check_sess
            ];
            // 
         $del_res =    CommandTemp::where('device_id',$id)->where('type','record_video')->delete();
            // Session::pull('device_id');
            // return response()->json($response, 200);
            // if($del_res == 1){
            //             // dd($del_res);
            // Session::pull('device_id');
            return response()->json($response, 200);
            // }else{
            //     dd("else");
            // }
            }
        }
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $downstreamResponse->tokensToDelete();

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $downstreamResponse->tokensToModify();

        // return Array - you should try to resend the message to the tokens in the array
        $downstreamResponse->tokensToRetry();

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function check_sess($id)
    {
        // $i=0;
    // dump("ID"."$id");
    // echo "i".$i;
        // $value = Session::get('device_id');
        $value = CommandTemp::where('device_id', $id)->where('type','record_video')->latest()->first();
        // dump("value".$value);
       if(empty($value)){
            // $i++;
            // sleep(2);
            // return "Asaaa";
             // dump("empty");
         return   $this->check_sess($id);    
        }else{

            // Session::put('device_id', $value);
            // $sess = Session::get('device_id');
            // dump($sess);

            // echo "string";
             // dump("value".$value);
            // return "Asa";
           return $value;
        }

    }

    public function increase_time()
    {
         return "asa";
        // 
        sleep(2);
       
        return $this->check_sess($id);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
