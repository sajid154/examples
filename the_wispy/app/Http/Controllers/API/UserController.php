<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Licence;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse($users->toArray(), 'User retrieved successfully.');
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

        $licience = new Licence;
        $user = new User;
        $random_password=Str::random(6);

        $user->name=$input['name'];
        $user->email=$input['email'];
       
        $user->password=Hash::make($random_password);//$input['password'];
        $user->save();
        
        $licience->status=0;
        $licience->licience_key=(string) Str::uuid();
        $licience->user_id=$user->id;
        $licience->days=$input['days'];

        $licience->save();
        //$licience->toArray()

        return $this->sendResponse(array('user_password'=>$random_password), 'User created with licence key successfully.');
    }


     /**
     * Validate Licience Key
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateliciencekey(Request $request)
    {


        $input = $request->all();

        $licience = new Licence;
        $key = $licience::where('licience_key', $input['licience_key'])->first();
        $msg='';
      
        if($key['status']==0 && $key['days']>0)
        {
            $liciencekeyupdate = $licience::find($key['id']);
            $liciencekeyupdate->status = '1';
            $liciencekeyupdate->save();
            $msg="user licience key is now activated";
        }
        else
        {
            $msg="Invalid licience key";
        }

        return $this->sendResponse($licience->toArray(), $msg);
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


        if (is_null($product)) {
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

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
            $msg="";
            if (Auth::attempt(array('email' =>$request->email,'password' =>$request->password)))
            {
                $user = Auth::user();
                $msg="User Authenticated";
            }
            else 
            {    
                $msg="wrong username and password";    
                //echo $msg;
            }
            return $this->sendResponse($user->only(['id', 'name', 'phone', 'email']), $msg);
    }
}


