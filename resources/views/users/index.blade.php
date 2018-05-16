@extends('layouts.app')

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	
	<h1>Users Index</h1>
	<h3>Active Users</h3>
	<a href="/user/create" class="btn btn-primary">New User</a>
	@if($users->count() < 1)
		<h3>No user available</h3>
	@else
		<h3>{{ $users->count() }} user(s) available</h3>
		@foreach($users as $user)
			<p>{{ $user->name }} <a href="/user/{{ $user->id }}/edit">Edit</a> <a href="/user/{{ $user->id }}/delete">Delete</a></p>
		@endforeach
	@endif

	<hr>
	<h3>Deleted Users</h3>
	@if($deleted_users->count() < 1)
		<h3>No deleted user available</h3>
	@else
		<h3>{{ $deleted_users->count() }} deleted user(s) available</h3>
		@foreach($deleted_users as $deleted_user)
			<p>{{ $deleted_user->name }} <a href="/user/{{ $deleted_user->id }}/restore">Restore</a></p>
		@endforeach
	@endif


@endsection
