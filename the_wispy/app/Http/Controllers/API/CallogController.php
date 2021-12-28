<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use App\ClientList;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use App\Call;
use App\CallLog;
use Carbon\Carbon;class CallogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calllog = DB::table('calllog')->get();
        return $this->sendResponse($calllog, '');
    }    public function getpackgedate()
    {
        $packagendate=(array)Carbon::now()->addDays(30);
        //print_r($packagendate['date']);
        $currentdate=(array)Carbon::now();
        //print_r($currentdate['date']);
        $date = Carbon::parse($packagendate['date']);
        $now = Carbon::now();
        print_r($now);
        $diff = $date->diffInDays($now);
        if($diff>0)
        {
            echo "nothing to do";
            Carbon::now()->subDays(-1);
        }
        else
        {
            die("true");        }
        // just days difference must be stored in database
        print_r($currentdate);
        //
        die();
    }      /**
     * Display call log with respect to device id
     *@param number,device_id,type,duration,name
     *@return \Illuminate\Http\Response
     */

        public function encode($value)
    {

        if ($value != null) {
            $value = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($value).'" , "dAtAbAsE98765432")) as encrypted');
            $value = $value[0]->encrypted;
        }
        return $value;
    }



    public function savecalls(Request $request)
    {

          try {

            // dd($request->all());
        $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
        // return $device;
        // echo "string";
        if($device) 
        {
            // return $device->uniqueid;
        foreach($request->user_calllogs as $value)
            {
                $value['device_id']= $device->id;

                $value['date_time'] = date("Y-m-d H:i:s", strtotime($value['date_time']));
                
                $checkLog = CallLog::where('device_id', $device->id)
                            ->where('name', $this->encode($value['name']))
                            ->where('number', $this->encode($value['number']))
                            ->where('type', $this->encode($value['type']))
                            ->where('duration', $this->encode($value['duration']))->first();
                
                if($checkLog == null){
                    $result = CallLog::create($value);
                }

                

            }
         return response()->json([
            'success' => true,
            // 'data'=> $result,
            'message' => ['Call Logs inserted successfully'],
            ], 200);
        }else{
                // echo "else";exit();
                  return response()->json([
                  'success' => false,
                   'message'=> ["Device does't exist."],
                  ], 200);
              }

        }
         
     catch (\Exception $ex) {


      // dd($ex->gettrace());
       return response()->json([
            'success' => false,
            'message' =>  [
              Str_limit($ex->getMessage(),150), 'On Line '. $ex->getline() ,'File Path '. $ex->getfile()  
            ],
          ]);
}


    }  

       /**
     * Display call log with respect to device id
     *
     * @return \Illuminate\Http\Response
     */
    public function getcallog(Request $request)
    {        $msg="";
        if($request->deviceuid)
        {
            $calllog = DB::table('calllog')->get();
            $msg="Records found";
        }
        else
        {
            $msg="Records not found";
        }
        return $this->sendResponse($calllog, $msg);
    }    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }        $product = Product::create($input);        return $this->sendResponse($product->toArray(), 'Product created successfully.');
    }    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);        if (is_null($product))
        {
            return $this->sendError('Product not found.');
        }        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }    public function generatepassword()
    {
        echo Str::random(6);
        // $hashed_random_password = Hash::make(Str::random(12));
        // echo $hashed_random_password;
        exit;
    }
}


