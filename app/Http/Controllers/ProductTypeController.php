<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use \Validator;

class ProductTypeController extends Controller
{    
    public function index(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = ProductType::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$productTypes = $query->orderByDesc('id')->paginate(10);

    	return view('producttype.index', compact('productTypes'));
    }

    public function create()
    {
    	return view('producttype.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('name', 'description');

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required|min:3'
        ], [
            'name.required' => 'Type name is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 3 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = new ProductType;

        $type->name = $request->name;
        $type->description = $request->description;

        $type->save();

        $request->session()->flash('success', 'Add Success !');

        return redirect()->route('product-types');
    }

    public function edit(Request $request, $id)
    {
        $type = ProductType::find($id);

        // dd($role);

        return view('producttype.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name', 'description');

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required|min:3'
        ], [
            'name.required' => 'Type name is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 3 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $type = ProductType::find($id);

        $type->name = $request->name;
        $type->description = $request->description;

        $type->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('product-types');
    }

    public function destroy(Request $request, $id)
    {
        $type = ProductType::find($id);

        $type->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('product-types');

    }
}
