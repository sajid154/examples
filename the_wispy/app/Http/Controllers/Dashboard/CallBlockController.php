<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientList;
use App\UserCallBlock;
use App\IncomingUserCallBlock;
class CallBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $clientlist = ClientList::find($id);

       $blockNumbers = UserCallBlock::where('device_id', $clientlist->id)->paginate(25);
        return view('user.callblock', compact('blockNumbers', 'clientlist', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('user.addcallblock', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'phone_number' => 'required|unique:user_call_blocks'
        ]);
    
        $input = $request->all();

        $callblock = new UserCallBlock();

        $callblock->device_id = $input['device_id'];
        $callblock->phone_number = $input['phone_number'];
        
        $callblock->save();
        
       return redirect('call-block/'.$input['device_id'])->with('success', 'Block number added successfully');
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
        $callblock = UserCallBlock::find($id);
        $callblock->delete();
        return redirect()->back()->with('success', 'Block number removed successfully');
    }


    public function incoming($id)
    {
        $device = ClientList::with('incoming_call_blocks')->find($id);
        $incomingCalls = IncomingUserCallBlock::where('device_id', $device->id)->paginate(25);
        return view('user.callblockincoming', compact('incomingCalls', 'id'));
    }


    public function incoming_delete($id)
    {
        $callblockIn = IncomingUserCallBlock::find($id);
        $callblockIn->delete();
        return redirect()->back()->with('success', 'Block number removed successfully');
    }



}
