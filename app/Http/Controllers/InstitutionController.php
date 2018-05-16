<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institution;
use Validator;

class InstitutionController extends Controller
{
    public function index(){
    	$institutions = Institution::all();
    	return view('institutions.index')->with('institutions', $institutions);
    }

    public function store(Request $request){
    	$institution = new Institution;
    	$institution->name = $request->input('name');
    	$institution->phone = $request->input('phone');
    	$institution->email = $request->input('email');

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:institutions|email',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return view('institutions.create')->withErrors($validator);
        }

    	if($institution->save()){
    		return back()->with('success', 'Institution created');
    	}
    	else{
    		return back()->with('danger', 'Institution not created');
    	}
    }

    public function edit($institution){
    	$institution = Institution::find($institution);
    	return view('institutions.edit')->with('institution', $institution);
    }

    public function update($institution, Request $request){
    	$institution = Institution::find($institution);
    	$institution->name = $request->input('name');
    	$institution->phone = $request->input('phone');
    	$institution->email = $request->input('email');

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


    	if($institution->save()){
    		return back()->with('success', 'Institution Updated');
    	}
    	else{
    		return back()->with('danger', 'Institution Not Updated');
    	}
    }

    public function destroy($institution){
    	$institution = Institution::find($institution);
    	if($institution->delete()){
    		return back()->with('success', 'Institution Deleted');
    	}
    	else{
    		return back()->with('danger', 'Institution Not Deleted');
    	}
    }
}
