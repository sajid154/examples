<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\ClientList;
use App\UserGeoFenceStatus;
use Validator;
use Exception;
class GeoFenceController extends  BaseController
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
          try {
                $device_id = $request->deviceID;
            
        $device = ClientList::where('uniqueid', $device_id)->where('device_status','active')->first();

        if($device == null){
            throw new Exception('Device not found');
        
        }

         $check = UserGeoFenceStatus::where('in_time', $request->in_time)->where('out_time', null)->where('date', $request->date)->where('device_id', $device->id)->latest()->first();

         if($check != null){
            $start = strtotime($request->date.' '.$request->in_time);

            $end = strtotime($request->date.' '.$request->out_time);
            $diff = ($end - $start)/60;
                 // dd($diff);

                 $check->update([

                                        'device_id'=>$device->id,
                                        'geo_fence_id'=>$request->geo_fence_id,
                                        'in_time'=>$request->in_time,
                                        'out_time'=>$request->out_time,
                                        'duration'=> $diff = ($end - $start)/60,
                                        'date'=>$request->date
                                        
                    ]);
                return $this->sendResponse($check, ['GeoFence Status Updated..']);

         }else{

                

                    $geoFence = UserGeoFenceStatus::create([

                                        'device_id'=>$device->id,
                                        'geo_fence_id'=>$request->geo_fence_id,
                                        'in_time'=>$request->in_time,
                                        'out_time'=>$request->out_time,
                                        'duration'=>$request->duration,
                                        'date'=>$request->date

                                        
                    ]);

              return $this->sendResponse($geoFence, ['GeoFence Status inserted..']);
}
   


        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' =>  [
                  Str_limit($ex->getMessage(),150), 'On Line '. $ex->getline() ,'File Path '. $ex->getfile()  
                ],
                  
              ]);
        }
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
}
