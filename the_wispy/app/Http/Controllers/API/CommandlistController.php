<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class CommandlistController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Commandlist = Commandlist::all();
        return $this->sendResponse($Commandlist->toArray(), 'Commandlist List retrieved successfully.');
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
     * Display commands
     *
     * @return \Illuminate\Http\Response
     */
    public function getcommands(Request $request)
    {
        $Commandlist = new Commandlist;
        $msg="";
        $commandlist = $Commandlist::where('DeviceUniqueId', $request->deviceuid)
               ->where('Pending', '1')
               ->get();


        return $this->sendResponse($commandlist,$msg);
    }


     /**
     * set commands
     *
     * @return \Illuminate\Http\Response
     */
    public function setcommands(Request $request)
    {
       
        $Commandlist = new Commandlist;
        $msg="";
        $Commandlist->DeviceUniqueId=$request->DeviceUniqueId;
        $Commandlist->CommandId=$request->CommandId;
        $Commandlist->Pending=$request->Pending;
        $Commandlist->Param1=$request->Param1;
        $Commandlist->Param2=$request->Param2;
        $Commandlist->Param3=$request->Param3;
        $Commandlist->Param4=$request->Param4;
        $Commandlist->AddedDateTime=date('Y-m-d H:i:s');
        $Commandlist->save();
        return $this->sendResponse($Commandlist->toArray(),$msg);
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


    /**
     * Get output list
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getoutputlist(Request $request)
    {
        $msg='';
    
        $outputlists = DB::table('clientlist')
            ->join('commandlist', 'clientlist.UniqueId', '=', 'commandlist.DeviceUniqueId')
            ->select('clientlist.*', 'commandlist.*')
            ->where('pending','=','0')
            ->get();
        return $this->sendResponse($outputlists,$msg);
    }
}