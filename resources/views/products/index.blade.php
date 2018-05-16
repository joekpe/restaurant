@extends('layouts.app')

@section('content')
	@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
	@elseif(Session::has('danger'))
		<div class="alert alert-danger">{{ Session::get('danger') }}</div>
	@endif
	
	<h1>Products Index</h1>
	<a href="/product/create" class="btn btn-primary">New Product</a>
	@if($products->count() < 1)
		<h3>No records available</h3>
	@else
		<h3>{{ $products->count() }} records available</h3>
		@foreach($products as $product)
			<p>{{ $product->name }} <img src="/images/{{$product->image}}" width="100px" height="100px">  <a href="/product/{{ $product->id }}/edit">Edit</a> <a href="/product/{{ $product->id }}/delete">Delete</a></p>
		@endforeach
	@endif


@endsection
