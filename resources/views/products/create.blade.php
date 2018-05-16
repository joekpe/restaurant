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
	
	<h1>New Product</h1>
	<a href="/products" class="btn btn-primary">View All</a>
	<form method="post" action="/product/store" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
	    	<label for="name">Product Name</label>
	        <input type="text" class="form-control" id="name" placeholder="Enter name of product" name="name">
	    </div>
	    <div class="form-group">
	    	<label for="cp">Cost Price</label>
	        <input type="number" class="form-control" id="cp" placeholder="Enter Cost Price" name="cost_price">
	    </div>
	    <div class="form-group">
	    	<label for="sp">Selling Price</label>
	        <input type="number" class="form-control" id="sp" placeholder="Enter Selling Price" name="selling_price">
	    </div>
	    <div class="form-group">
	    	<label for="image">Image</label>
	        <input type="file" class="form-control" id="image" name="image">
	    </div>
	    <input type="hidden" name="institution_id" value="{{ Auth::user()->institution_id }}">
	    <button type="submit" class="btn btn-success">Save</button>
	</form>


@endsection
