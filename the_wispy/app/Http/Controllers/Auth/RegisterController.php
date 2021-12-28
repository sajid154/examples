<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\registerUser;
use App\Mail\CongratsMail;
use Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/devices';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(session()->get('ref_code') != null){
            $the_ref = session()->get('ref_code');
            // dd($the_ref);
        }else{
            $the_ref = null;
            // dd($the_ref);
        }

        $create=User::create([
            //'name' => $data['name'],
            'email' => $data['email'],
            'system_requirement' => $data['password'],
            'password' => Hash::make($data['password']),
			'token' => sha1(time()),
            'ref_code'=>$the_ref
        ]);
		//$randid=rand(0,1000);
            DB::insert("insert into role_user set user_id='$create->id',role_id='3'");
			$emails = ['registrations@thewispy.com'];
        $data_user = ([
            //'name' => $request->get(‘name’),
            'email' => $data['email'],
            'system_requirement' => $data['password']
        ]);
			Mail::to($data['email'])->send(new CongratsMail($data_user));
			Mail::to($emails)->send(new registerUser($data_user));
            session()->forget('ref_code');  
            return $create;
    }
    protected function registered(Request $request, $user)
    {
        
        $res = get_user_location($request);
        $user->update($res);
    }
}
