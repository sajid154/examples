<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('role:Admin');
    }
    public function index()
    {
        return view('admin.home');
    }
public function users()
	{
		$users = \App\User::all();
		return view('admin.users',compact('users'));
	}
public function show($id)
    {
		$singlesuer = \App\User::find($id);
		return view ('admin.show',compact('singlesuer'));
    }	
}
