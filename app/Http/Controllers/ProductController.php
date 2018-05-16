<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Validator;

class ProductController extends Controller
{
    public function index(){
    	return view('products.index')->with('products', Product::all());
    }

    public function create(){
    	return view('products.create');
    }

    public function store(Request $request){
    	$product = new Product;
    	$product->name = $request->input('name');
    	$product->cost_price = $request->input('cost_price');
    	$product->selling_price = $request->input('selling_price');
    	$product->institution_id = $request->input('institution_id');


    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return view('products.create')->withErrors($validator);
        }

    	$product->image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $product->image);
        if($product->save()){
            return back()->with('success', 'Product Created');
        }
        else{
            return back()->with('danger', 'Product not created');
        }

    }

    public function edit($product){
    	$product = Product::find($product);
    	return view('products.edit')->with('product', $product);
    }

    public function update($product, Request $request){
    	$product = Product::find($product);
    	$product->name = $request->input('name');
    	$product->cost_price = $request->input('cost_price');
    	$product->selling_price = $request->input('selling_price');

    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'cost_price' => 'required',
            'selling_price' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


    	if($product->save()){
    		return back()->with('success', 'Product Updated');
    	}
    	else{
    		return back()->with('danger', 'Product Not Updated');
    	}
    }

    public function update_image($product, Request $request){
    	$product = Product::find($product);
   
    	$validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

    	$product->image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $product->image);
        if($product->save()){
            return back()->with('success', 'Product Update');
        }
        else{
            return back()->with('danger', 'Product not Updated');
        }

    }

    public function destroy($product){
    	$product = Product::find($product);
    	if($product->delete()){
    		return back()->with('success', 'Product Deleted');
    	}
    	else{
    		return back()->with('danger', 'Product Not Deleted');
    	}
    }
}
