<?php

namespace App\Http\Controllers\Affiliat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\AgentDetails;
use Str;
use Cookie;
use Illuminate\Support\Facades\DB; 

class RagisterController extends Controller
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password'=> ['required', 'string', 'min:8', 'confirmed'],
            'street_address'=>'required',
            'additional_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'zip_code'=>'required'
        ]);


        DB::beginTransaction();

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=> '1' 
        ]);

       $relation = $user->roles()->attach(4);

        $agentDetail = AgentDetails::create([
                'agent_id'=> $user->id,
                'reference_code'=> Str::random(16),
                'company_name' => $request->company_name,
                'company_website' => $request->company_website,
                'street_address' => $request->street_address,
                'additional_address' => $request->additional_address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'phone_number' => $request->phone_number,
                'zip_code' => $request->zip_code,
                'paypal_account' => $request->paypal_account,
                'bank_ac_title' => $request->bank_ac_title,
                'bank_name' => $request->bank_name,
                'bank_iban' => $request->bank_iban
                    
        ]);

        if($user && $agentDetail){

            DB::commit();
            return redirect()->route('login');

        }
        else{
            DB::rollback();
             return redirect()->back();

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
