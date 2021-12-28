<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CallLog;
use DataTables;
use App\CaptureScreenshot;
use App\RecordAudio;
use App\CommandTemp;
use App\ClientList;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Redirect;
use Illuminate\Support\Facades\Session;
class RecordAudioController extends Controller
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
        return view ('user.record_audio',compact('device_id','plan_id','id','user_id'));
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
        $data = RecordAudio::where('device_id', $request->device_id)->get();

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
       $dataBuilder->addData(['run_command' => 'record_audio','recording_time' => $recording_time ]);


        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // dump($token);
        // dump($option);
        // dump($notification);
        // dd($data);exit();
                    $token = ClientList::where('id', $id)->select('device_token')->first();
            // dd($token);
            $token = $token->device_token;
        // $token = "f9FZ1LLKRxe5zZZZil1R4h:APA91bE9heVjDZUCjgCDZCzBgcSWP14JGy926Jh_WBIS67fkr5hQmHEIeVU7b8iQ6mlXy6O1iuNZrKrtN-aBeSAx5XHzeijDd_NnIr1X_u_oEV1yZg0kwYTVBTutGwVwg-wFTGegOeXF";

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
        // dump($res);
        if($res == 1){

          $check_sess =   $this->check_sess($id);
          
    
            if($check_sess != null){

            //      $check_sess =   $this->check_sess($id);
            
            // }else{
                // dd($check_sess);
                    // $get_record = Session::get('device_id');
                    //      echo "string";
                    // dd($get_record);

                    // dd($get_record);
                    // return response()->json([
                        // 'data' => $data]);
                
                $response = [
                    'success' => true,
                    'data' => $check_sess
                    ];
                    // 
                    $del_res = CommandTemp::where('device_id',$id)->where('type','record_audio')->delete();
                    
                    // if($del_res == 1){
                    //     // dd($del_res);
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
        $value = CommandTemp::where('device_id', $id)->where('type','record_audio')->latest()->first();
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
	public function run_command_sync(Request $request, $id) {
		  $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder();
		$dataBuilder = new PayloadDataBuilder();
       $dataBuilder->addData(['run_command' => 'sync_data']);


        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
		//$token = ClientList::where('id', $id)->select('device_token')->first();
            // dd($token);
         //   $token = $token->device_token;
        $token = ClientList::where('id', $id)->first();
            // dd($token);
        $token->last_sync = date("Y-m-d h:i:s");
        $token->save();

        $token = $token->device_token;
        // dd($token);
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
		
		
		$res = $downstreamResponse->numberSuccess();
        
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
		if($res == 0){
          // $id = 679;
          return view('user.sync_error',compact('id'));
        }
        return Redirect::back()->with('update', 'Data Updated');
	}

}
