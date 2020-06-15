<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use \Validator;

class ProductController extends Controller
{  
    public function index(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = Product::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$products = $query->orderByDesc('id')->paginate(10);

    	return view('product.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('product.detail', compact('product'));
    }

    public function create()
    {
        $types = ProductType::all();

    	return view('product.create', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'type', 'description', 'unit_price', 'sale_price', 'infor', 'new', 'image', 'packing');

        $validator = Validator::make($data, [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required|min:4',
            'unit_price' => 'required',
            'sale_price' => 'required',
            'infor' => 'required|min:3',
            'new' => 'required',
            'image' => 'required',
            'packing' => 'required|min:2'
        ], [
            'name.required' => 'Product Name is required',
            'type.required' => 'Type is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 4 characters',
            'unit_price.required' => 'Unit Price is required',
            'sale_price.required' => 'Sale Price is required',
            'infor.required' => 'Infor is required',
            'infor.min' => 'Infor is at least 3 characters',
            'new.required' => 'New is required',
            'image.required' => 'Image is required',
            'packing.required' => 'Packing is required',
            'packing.min' => 'Packing is at least 4 characters',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->image;
        $fileName = $request->file('image')->storeAs('product-image',time().'.jpg');
        $path = $file->move('product-image', $fileName);
        $pathName = str_replace('\\', '/', $path);

        // dd($pathName);

        $product = new Product;

        $product->name = $request->name;
        $product->type_id = $request->type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->sale_price = $request->sale_price;
        $product->infor = $request->infor;
        $product->new = $request->new;
        $product->image = $pathName;
        $product->packing = $request->packing;

        $product->save();

        $request->session()->flash('success', 'Add Success !');

        return redirect()->route('products');
    }

    public function edit(Request $request, $id)
    {
        $product = Product::find($id);

        $types = ProductType::all();

        return view('product.edit', compact('product', 'types'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name', 'type', 'description', 'unit_price', 'sale_price', 'new', 'infor', 'packing');

        $validator = Validator::make($data, [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required|min:4',
            'unit_price' => 'required',
            'sale_price' => 'required',
            'infor' => 'required|min:3',
            'new' => 'required',
            'packing' => 'required|min:2'
        ], [
            'name.required' => 'Product Name is required',
            'type.required' => 'Type is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 4 characters',
            'unit_price.required' => 'Unit Price is required',
            'sale_price.required' => 'Sale Price is required',
            'infor.required' => 'Infor is required',
            'infor.min' => 'Infor is at least 3 characters',
            'new.required' => 'New is required',
            'packing.required' => 'Packing is required',
            'packing.min' => 'Packing is at least 4 characters',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = $request->file('image')->storeAs('product-image',time().'.jpg');
            $path = $file->move('product-image', $fileName);
            $pathName = str_replace('\\', '/', $path);
            $product->image = $pathName;
        }

        $product->name = $request->name;
        $product->type_id = $request->type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->sale_price = $request->sale_price;
        $product->new = $request->new;
        $product->infor = $request->infor;
        $product->packing = $request->packing;

        $product->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('products');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);

        $product->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('products');

    }
}
