<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        if($user->profile == null){
            $profile = Profile::create([
                'facebook'=>'https://www.facebook.com/',
                'province'=>'mansoura',
                'gender'=>'Male',
                'user_id'=>$id,
                'bio'=>'Hi there i\'m using this App :D',
            ]);
        }
        return view('users.profile')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'province'=>'required',
            'gender'=>'required',
            'bio'=>'required'
        ]);
        $user= Auth::user();
        $user->name = $request->name;
        $user->profile->province = $request->province;
        $user->profile->facebook = $request->facebook;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->profile->save();


        if($request->has('password'))
        {
            $user->password = bcrypt($request->password);
            $user->save();

        }

        return redirect()->back();
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
