<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Setsetting;

use App\Licence;
use Validator;
use DB;
use Illuminate\Support\Str;


class SetsettingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function mytests()
    {
        selectrecords();
        die("testing");
    }

     /**
     * Get settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getsettings(Request $request)
    {
       
        $Setsetting=new Setsetting;
    
        $msg="";
        $Setsetting = $Setsetting::where('DeviceUniqueId', $request->deviceuid)
               ->get();


        return $this->sendResponse($Setsetting,$msg);

       // return $this->sendResponse($licience->toArray(), 'User created with licence key successfully.');
    }


    /**
    * Set settings
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function setsettings(Request $request)
    {
       
        $Setsetting=new Setsetting;
    
        $msg="";

        $forceWifiOnForRecordUpload=($request->forceWifiOnForRecordUpload=='true'?1:0);
        $ServerTalkInterval=(int)$request->serverTalkInterval;
        $cards = DB::statement( "REPLACE INTO settings (DeviceUniqueId, ForceWifiOnForRecordUpload, 
        ServerTalkInterval) VALUES ('$request->deviceuid','$forceWifiOnForRecordUpload','$ServerTalkInterval')");
        if($cards=='true')
        {
            $msg="Records updated successfully";
        }
        else
        {
            $msg="Error in records";
        }
        
        // $Setsetting->DeviceUniqueId=$Setsetting::firstOrNew(['DeviceUniqueId'=>$request->deviceuid]);
        // $Setsetting->ForceWifiOnForRecordUpload=($request->forceWifiOnForRecordUpload=='true'?1:0);
        // $Setsetting->ServerTalkInterval=$request->serverTalkInterval;
        // $Setsetting->save();
        return $this->sendResponse(array('deviceuid'=>$request->deviceuid),$msg);
    }
    public function setoutput(Request $request)
    {
        $uniqueid=$request->uniqueid;
        $commandid=$request->commandid;
        $param1=$request->param1;
        $param2=$request->param2;
        $param3=$request->param3;
        $param4=$request->param4;
       
        $output=getResultString($request->output,$commandid,$uniqueid);
    }
    
}