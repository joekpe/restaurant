@extends('layouts.app')

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	
	<h1>institutions Index</h1>
	<a href="/institution/create" class="btn btn-primary">New institution</a>
	@if($institutions->count() < 1)
		<h3>No records available</h3>
	@else
		<h3>{{ $institutions->count() }} records available</h3>
		@foreach($institutions as $institution)
			<p>{{ $institution->name }} <a href="/institution/{{ $institution->id }}/edit">Edit</a> <a href="/institution/{{ $institution->id }}/delete">Delete</a></p>
		@endforeach
	@endif


@endsection
