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
	
	<h1>New User</h1>
	<a href="/users" class="btn btn-primary">All Users</a>

	<form method="post" action="/user/{{ $user->id }}/update">
		@csrf
		{{ method_field('PATCH') }}
		<div class="form-group">
	    	<label for="name">Full Name</label>
	        <input type="text" class="form-control" id="name" placeholder="Enter name of user" name="name" value="{{ $user->name }}">
	    </div>
	    <!-- <div class="form-group">
	    	<label for="email">E-mail</label>
	        <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="email" value="{{ $user->email }}">
	    </div> -->
	    <div class="form-group">
	    	<label>Access Level</label>
	       <select class="form-control" name="access_level">
	       		<option value="{{ $user->access_level }}">{{ $user->access_level }}</option>
	       		<option value="admin">Admin</option>
	       		<option value="user">Normal User</option>
	       </select>
	    </div>
	    <div class="form-group">
	    	<label>Institution</label>
	       <select class="form-control" name="institution_id">
	       		<option value="">--Select Institution--</option>
	       		@foreach($institutions as $institution)
					<option value="{{ $institution->id }}"> {{ $institution->name }} </option>
				@endforeach
	       </select>
	    </div>

	    <button type="submit" class="btn btn-success">Save</button>
	</form>


@endsection
