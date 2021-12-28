<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated($request, $user)
    {   
        $res = get_user_location($request);
        // $user->update($res);
            
        if($request->user()->isAdmin()) {
            return redirect()->intended('/admin');
        }
		elseif($request->user()->isSuperAdmin()) {
            return redirect()->intended('/superadmin');
        }

        elseif($request->user()->isAgent()) {
            return redirect()->intended('/affiliate');
        }

        elseif($request->user()->isDigitaMarketing()) {
            return redirect()->intended('/marketing');
        }

        if(Auth::user()->id == 19){
             return redirect()->intended('/dashboard/1');
        }
            return redirect()->intended('/devices');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
