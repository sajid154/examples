<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientList;
use App\GmailEmail;
class GmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $clientlist = ClientList::find($id);
        return view('user.gmail', compact('clientlist', 'id'));

        // $mails = GmailEmail::where('device_id', $id)->paginate(50);
        // dd($mails);
        // return response()->json({})
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
        //
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
         $gmail = GmailEmail::find($id);
         $gmail->delete();
         return "delete";
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function default($id)
    {        
        $mails = GmailEmail::where('device_id', $id)->orderBy('id', 'desc')->paginate(25);
        return response()->json(['mails'=>$mails->items(), 'pages'=>$mails->lastPage()]);
    }

    public function searchMail($id)
    {

        $mail = GmailEmail::find($id);
        
        return response()->json($mail);

    }


    public function filter(Request $request, $id)
    {

        // return $request->all();
        
        $arr_search  = array();
        
        if($request->has('name') && $request->name != null){
            $arr_search[] = array('sender', 'like', '%'. $request->name .'%');
        }
        
        if($request->has('subject') && $request->subject != null){
            $arr_search[] = array('subject','like','%'. $request->subject .'%');
        }
        if($request->has('from') && $request->from != null){
            $arr_search[] = array('date_time', '>=', date('Y-m-d H:i:s', strtotime($request->from)));
        }
        if($request->has('to') && $request->to != null){
            $arr_search[] = array('date_time', '<=', date('Y-m-d H:i:s', strtotime($request->to)));
        }
        
       
        $mails = GmailEmail::where($arr_search)->where('device_id', $id)->orderBy('id', 'desc')->paginate(25);
        return response()->json(['mails'=>$mails->items(), 'pages'=>$mails->lastPage()]);
    
    }


}
