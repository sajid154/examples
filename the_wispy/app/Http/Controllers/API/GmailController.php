<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\GmailEmail;
use Validator;
use Exception;
use DB;
use App\ClientList;
class GmailController extends BaseController
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


    public function saveGmailEmail(Request $request)
        {   
            try {
            $validator = Validator::make($request->all(), [
                    
                'deviceID' => 'required',
                'message'=> 'required'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }

            $device_id = $request->deviceID;
            $sender = $request->senderName;
            $subject = $request->subject;
            $message = $request->message;
            $date_time = $request->date_time;
            
            
            $device = ClientList::where('uniqueid', $device_id)->where('device_status','active')->first();
            
            if($device == null){
            
                throw new Exception('Device not found');
        
            }

        
        
            $check = GmailEmail::where('device_id', $device->id)->where('sender', $sender)->where('subject', $subject)
            ->where('message', $message)->first(); 
            $myMail = '';
        
            if($check == null){
                $myMail = GmailEmail::create([
                    "device_id"=>$device->id,
                    "sender"=>$sender,
                    "subject"=>$subject,
                    "message"=>$message,
                    "date_time"=>date('y-m-d'),

                ]);
            }
           
            return $this->sendResponse($myMail, ['Gmail inserted successfully']);

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
