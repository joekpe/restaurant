@extends('layouts.app')

@section('content')

	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif

	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	
	<h1>New Institution</h1>
	<a href="/institutions" class="btn btn-primary">View All</a>
	<form method="post" action="/institution">
		@csrf
		<div class="form-group">
	    	<label for="name">Institution Name</label>
	        <input type="text" class="form-control" id="name" placeholder="Enter name of institution" name="name">
	    </div>
	    <div class="form-group">
	    	<label for="phone">Institution Phone Number</label>
	        <input type="text" class="form-control" id="phone" placeholder="Enter contact number of institution" name="phone">
	    </div>
	    <div class="form-group">
	    	<label for="email">Institution E-mail</label>
	        <input type="email" class="form-control" id="email" placeholder="Enter E-mail of institution" name="email">
	    </div>
	    <button type="submit" class="btn btn-success">Save</button>
	</form>


@endsection
