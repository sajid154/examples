<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\ViberSms;
use App\ClientList;
use Exception;
use Validator;
use DB;

class ViberController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function encode($value)
    {

        if ($value != null) {
            $value = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($value).'" , "dAtAbAsE98765432")) as encrypted');
            $value = $value[0]->encrypted;
        }
        return $value;
    }


    public function saveViberMessage(Request $request)
     {
            // dd($request->all());
            try {
                
                $validator = Validator::make($request->all(), [
                    'contactName' => 'required',
                    'deviceID' => 'required',
                    'viberDataList'=> 'required|array|min:1'
                ]);
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
           
                $device_id = $request->deviceID;
                $contact_name = $request->contactName;
                $viber_messages = $request->viberDataList;
                
                $device = ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

                if($device == null){
                    throw new Exception('Device not found');
                }

                foreach($viber_messages as $message){
                    
               
                    $checkSameDbMsg = ViberSms::where('device_id', $device->id)
                    ->where('time', date("H:i:s", strtotime($message['time'])))
                    ->where('message', $this->encode($message['msg']))
                    ->where('status', $this->encode($message['status']))->first();
            
                    
                    if($checkSameDbMsg == null){

                    ViberSms::create([
                                        'contact_name'=>$contact_name,
                                        'device_id'=>$device->id,
                                        'time'=>date("H:i:s", strtotime($message['time'])),
                                        'message'=>$message['msg'],
                                        'status'=>$message['status']
                    ]);
                    }
                }   

              return $this->sendResponse($viber_messages, ['Viber Sms inserted successfully']);

            } catch (\Exception $ex) {
                return response()->json([
                    'success' => false,
                    'message' =>  [
                      Str_limit($ex->getMessage(),150),'On Line '. $ex->getline() ,'File Path '. $ex->getfile()  
                    ],
                      
                  ], 200);
            }

     }
}
