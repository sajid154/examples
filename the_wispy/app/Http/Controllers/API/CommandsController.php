<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Commandlist;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class CommandsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$calllog = DB::table('CALLLOG_'.$request->deviceuid)->get();
        //return $this->sendResponse($calllog, '');
    }

     /**
     * Display sms conversation
     *
     * @return \Illuminate\Http\Response
     */
    public function getcommands(Request $request)
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