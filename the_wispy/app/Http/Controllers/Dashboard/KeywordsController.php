<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserKeyword;
use App\ClientList;
use App\SearchedKeyword;
class KeywordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $clientlist = ClientList::with('keywords')->find($id);
        $keywords = UserKeyword::where('device_id', $clientlist->id)->paginate(25);
        return view('user.keywords_alert', compact('keywords', 'clientlist', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        return view('user.addkeyword-alert', compact('id'));
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

        $validatedData = $request->validate([
        'keyword' => 'required'
        ]);
    
        $input = $request->all();

        $keyword = new UserKeyword();

        $keyword->device_id = $input['device_id'];
        $keyword->keyword = $input['keyword'];
        
        $keyword->save();
        
       return redirect('keywords-alert/'.$input['device_id'])->with('success', 'Keyword added successfully');
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
        $userKeyword = UserKeyword::find($id);
        $userKeyword->delete($id);

        return redirect()->back()->with('success', 'Keyword removed successfully...'); 
    }

    public function searched_keywords($id)
    {
        $device = ClientList::with('searched_keywords')->find($id);
        $searched_keywords = SearchedKeyword::where('device_id', $device->id)->paginate(25);
        return view('user.keywords_searched', compact('searched_keywords', 'id'));
    }

    public function searched_keywords_destroy($id)
    {
        $keyword = SearchedKeyword::find($id);
        $keyword->delete($id);

        return redirect()->back()->with('success', 'Searched Keyword removed successfully...'); 
    }



}
