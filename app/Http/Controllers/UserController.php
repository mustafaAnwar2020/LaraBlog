<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = User::all();
        return view('users.index')->with('user',$user);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|unique:users',
            'password'=>'required|min:8|string|confirmed'
        ]);

        $user = User::create([
            'name'=> $request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email

        ]);
        // dd($user);
        $profile = Profile::create([
            'facebook'=>'https://www.facebook.com/',
            'province'=>'mansoura',
            'gender'=>'Male',
            'user_id'=>$user->id,
            'bio'=>'Hi there i\'m using this App :D',

        ]);
        return redirect()->route('users.index');
    }

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
        $user = User::find($id);
        $user->profile->delete($id);
        $user->delete($id);
        return redirect()->back();

    }



}
