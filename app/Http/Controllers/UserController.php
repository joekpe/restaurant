<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Institution;
use Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){

    	$credentials = $request->only('email', 'password');
    	if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
        else{
        	return redirect('/');
        }

    }

    public function index(){
        $users = User::all();
        $deleted_users = User::onlyTrashed()->get();
        return view('users.index')->with('users', $users)->with('deleted_users', $deleted_users);
    }

    public function create(){
        $institutions = Institution::all();
        return view('users.create')->with('institutions', $institutions);
    }

    public function store(Request $request){
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->access_level = $request->input('access_level');
        $user->institution_id = $request->input('institution_id');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'access_level' => 'required',
            'institution_id' => 'required',
        ]);

        if ($validator->fails()) {
            return view('users.create')->withErrors($validator)->with('institutions', Institution::all());
        }

        if($user->save()){
            return back()->with('success', 'user created');
        }
        else{
            return back()->with('danger', 'user not created');
        }
    }

    public function edit($user){
        $user = User::find($user);
        return view('users.edit')->with('user', $user)->with('institutions', Institution::all());
    }

     public function update($user, Request $request){
        $user = User::find($user);
        $user->name = $request->input('name');
        $user->access_level = $request->input('access_level');
        $user->institution_id = $request->input('institution_id');

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'access_level' => 'required',
            'institution_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('institutions', Institution::all());
        }

        if($user->save()){
            return back()->with('success', 'user updated');
        }
        else{
            return back()->with('danger', 'user not updated');
        }
    }

    public function destroy($user){
        $user = User::find($user);
        if($user->delete()){
            return back()->with('success', 'User Deleted');
        }
        else{
            return back()->with('danger', 'User Not Deleted');
        }
    }

    public function restore($user){
        $user = User::withTrashed()->find($user);
        if($user->restore()){
            return back()->with('success', 'User Restored');
        }
        else{
            return back()->with('danger', 'User Not Restored');
        }
    }
}
