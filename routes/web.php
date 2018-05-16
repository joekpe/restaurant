<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::post('/login', 'UserController@login');

Route::get('/logout',function(){
	Auth::logout();
	return view('login');
	
});

Route::group(['middleware' => 'auth'], function(){

	Route::get('/dashboard', function () {
		if (Auth::check()) {
			return view('dashboard');
		}
		else{
			return view('login');
		}
	    
	});

	//institutions
	Route::get('/institutions', 'InstitutionController@index');

	Route::get('/institution/create', function () {
	    return view('institutions.create');
	});

	Route::post('/institution', 'InstitutionController@store');

	//view and edit institution
	Route::get('/institution/{institution}/edit', 'InstitutionController@edit');
	Route::patch('/institution/{institution}/update', 'InstitutionController@update');

	//delete institution
	Route::get('/institution/{institution}/delete', 'InstitutionController@destroy');

	//users
	Route::get('/users', 'UserController@index');

	Route::get('/user/create', 'UserController@create');

	Route::post('/user/store', 'UserController@store');

	//view and edit user
	Route::get('/user/{user}/edit', 'UserController@edit');
	Route::patch('/user/{user}/update', 'UserController@update');

	//delete user
	Route::get('/user/{user}/delete', 'UserController@destroy');

	//restore user
	Route::get('/user/{user}/restore', 'UserController@restore');

	//products index
	Route::get('products', 'ProductController@index');

	Route::get('/product/create', 'ProductController@create');

	Route::post('/product/store', 'ProductController@store');

	//view and edit product
	Route::get('/product/{product}/edit', 'ProductController@edit');
	Route::patch('/product/{product}/update', 'ProductController@update');
	Route::patch('/product/{product}/update_image', 'ProductController@update_image');

	//delete user
	Route::get('/product/{product}/delete', 'ProductController@destroy');

});
