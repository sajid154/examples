<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;;
use App\ClientList;
use App\SearchedKeyword;
use Validator;
use Exception;


class UserKeywordController extends BaseController
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
        // return $request->all();
        //return strlen($request->deviceID);
     try{


            $validator = Validator::make($request->all(), [
                    
                    'deviceID' => 'required',
                    'keywordsList'=> 'required|array|min:1'
                ]);
                if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
                }
           
                $device_id = $request->deviceID;
                $keywordsList = $request->keywordsList;
            
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

        if($device == null){
            throw new Exception('Device not found');
        
        }


                foreach($keywordsList as $keyword){
                    
                    SearchedKeyword::create([

                                        'device_id'=>$device->id,
                                        'keyword'=>$keyword['keyword'],
                                        'date_time'=>$keyword['dateTime'],
                                        
                    ]);

                }   

              return $this->sendResponse($keywordsList, ['Searched keywords list inserted..']);

   


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


    public function getKeywordsList($device_id)
    {
        try {
            
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();

        if($device == null){
            throw new Exception('Device not found');
        }
        
        $getKeywords = $device->keywords->pluck('keyword');

        if($getKeywords == null){
            
            throw new Exception('No Keyword is added...');
        }

        return response()->json([
                                'device_unique_id'=>$device_id,
                                'keywordsList'=>$getKeywords
        ]);



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
