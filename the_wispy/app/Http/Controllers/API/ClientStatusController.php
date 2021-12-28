<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\ClientDataStatus;
use Validator;
use Exception;
use App\ClientList;
class ClientStatusController extends BaseController
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

    public function saveClientList(Request $request)
    {

            try{

            $validator = Validator::make($request->all(), [
                    
                    'deviceID' => 'required',
                    
                ]);
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
           
                     $device_id = $request->deviceID;
                $dataList = $request->dataList;
            
        $device= ClientList::where('uniqueid', $device_id)->where('device_status','active')->first();

        if($device == null){
            throw new Exception('Device not found');
        
        }

            if($device->data_status == null){

                    ClientDataStatus::create([
                                             'device_id'=>$device->id,
                                             'call_logs'=>$dataList['calllogs'],
                                             'sms'=>$dataList['sms'],
                                             'calendars'=>$dataList['calendars'],
                                             'photos'=>$dataList['photos'],
                                             'videos'=>$dataList['videos'],
                                             'voices'=>$dataList['voices'],
                                             'contacts'=>$dataList['contacts'],
                                             'installed_applications'=>$dataList['installed_applications'],
                                                    

                                            ]);
            }else{
             $data_status = ClientDataStatus::where('device_id', $device->id)->first();

             $data_status->update([
              'call_logs'=>$dataList['calllogs'],
                                             'sms'=>$dataList['sms'],
                                             'calendars'=>$dataList['calendars'],
                                             'photos'=>$dataList['photos'],
                                             'videos'=>$dataList['videos'],
                                             'voices'=>$dataList['voices'],
                                             'contacts'=>$dataList['contacts'],
                                             'installed_applications'=>$dataList['installed_applications'],        
                    ]);
            }

        

              return $this->sendResponse($dataList, ['Device Data List inserted..']);

   


        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' =>  [
                  Str_limit($ex->getMessage(),150), 'On Line '. $ex->getline() ,'File Path '. $ex->getfile()  
                ],
                  
              ]);
        }

    }


}
