<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;
use App\SMS;
use App\ClientList;
use Exception;

class SmsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $calllog = DB::table('CALLLOG_'.$request->deviceuid)->get();
        return $this->sendResponse($calllog, '');
    }


    public function encode($value)
    {

        if ($value != null) {
            $value = DB::select('SELECT TO_BASE64(AES_ENCRYPT( "'.addslashes($value).'" , "dAtAbAsE98765432")) as encrypted');
            $value = $value[0]->encrypted;
        }
        return $value;
    }

     /**
     * Display sms conversation
     *@param number,type,message,name,device_id
     *@return \Illuminate\Http\Response
     */
     public function savedevicemessage(Request $request)
     {
          try {
        // dd($request->all());
        $sms=array();
        if(!$request->has('device_id')){
            throw new Exception('Device id is missing');
        }
        $device_id = $request->device_id;
        $device= ClientList::where('uniqueid',$device_id)->where('device_status','active')->first();
        
        if($device){
			
            foreach($request->user_logs as $value){
                

            $value['device_id']= $device->id;
            $value['date_time'] = date("Y-m-d H:i:s", strtotime($value['date_time']));
			$message = encrypt_attr(trim($value['message']));
			$name = encrypt_attr($value['name']);
            $number = encrypt_attr($value['number']);
            $type = encrypt_attr($value['type']);

          $check = SMS::where('date_time', $value['date_time'])->where('message', $this->encode($message))->where('device_id', $value['device_id'])->where('type', $this->encode($type))->first();

            if($check == null){
                $result=SMS::create(['number' => $number, 'type' => $type,'message' => $message,'date_time' => $value['date_time'], 'name' => $name, 'device_id' => $value['device_id'], 'status'=>$value['status']]);
            }

            }
            return $this->sendResponse($sms, ['Sms inserted successfully']);
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
              
          ], 200);
    }

        
     }



     /**
     * Display sms conversation
     *
     * @return \Illuminate\Http\Response
     */
    public function displaysmsconversation(Request $request)
    {
       
        $msg="";
        if($request->deviceuid && $request->threadid)
        {
            $calllog = DB::table('smses_'.$request->deviceuid)->where('ThreadId', $request->threadid)->
            orderBy('Date', 'desc')
            ->get();
            $msg="Records found";
        }
        else
        {
            $msg="Records not found";
        }
        return $this->sendResponse($calllog,$msg);
    }


    /**
    * Display sms conversation
    *
    * @return \Illuminate\Http\Response
    */
    public function displaysmses(Request $request)
    {
       
        $msg="";
        if($request->deviceuid)
        {
            $calllog = DB::table('smses_'.$request->deviceuid)
            ->get();
            $msg="Records found";
        }
        else
        {
            $msg="Records not found";
        }
        return $this->sendResponse($calllog,$msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $product = Product::create($input);


        return $this->sendResponse($product->toArray(), 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);


        if (is_null($product)) 
        {
            return $this->sendError('Product not found.');
        }


        return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	 public function savetextmessage(Request $request)
    {
        $device= ClientList::where('id',$request->device_id)->first();
        $call=new SMS;        
		if($device)
        {
			
            $call->number=$request->number;
            $call->type=$request->type;
            $call->message=$request->message;
            $call->device_id=$device->id;
            $call->name=$request->name;
            $call->status=$request->status;
			$call->save();
            $msg="";        
			}
        else
        {
            $msg="No device id recarding this record found";
        }
        return $this->sendResponse($call->toArray(),$msg);
        //return $this->sendResponse($calllog,"call logs is added successfully");
    }

    public function update(Request $request, Product $product)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();


        return $this->sendResponse($product->toArray(), 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
    }

    public function generatepassword()
    {
        echo Str::random(6);
        // $hashed_random_password = Hash::make(Str::random(12));
        // echo $hashed_random_password;
        exit;
    }
}