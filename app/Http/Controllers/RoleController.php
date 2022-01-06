<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $user = User::all();
        return view('roles.index')->with('user',$user);
    }


    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('roles.edit')->with('user',$user);
    }

    public function update(Request $request, $id){
        $user = User::where('id',$id)->first();
        $this->validate($request,['role'=>'required']);
        if($request->role === 'Admin')
        {
            $newRole = 1;
        }
        else
        {
            $newRole = 0 ;
        }
        $user->is_admin = $newRole;
        $user->save();
        return redirect()->back();
    }

}
