<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\BrowserHistory;
use Validator;
use Exception;
use App\ClientList;

class BrowserHistoryController extends BaseController
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


    public function saveBrowserHistory(Request $request)
    {

            try {

                $validator = Validator::make($request->all(), [
                    'deviceID' => 'required',
                    'historyDataList'=> 'required|array|min:1'
                ]);
           
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
           

                $device_id = $request->deviceID;

                $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

                if($device == null){
                    throw new Exception('Device not found');
                }


                $history_urls = $request->historyDataList;



                foreach($history_urls as $url){
                   
                    BrowserHistory::create([
                        'device_id'=> $device->id,
                        'browser_name'=>$url['browserName'],
                        'url_name'=>$url['urlName'],
                        'date_time'=>$url['dateTime'],
                    ]);
                }

                return $this->sendResponse($history_urls, ['Browsers History inserted successfully']);


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
