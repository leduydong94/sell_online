<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Validator;

class SlideController extends Controller
{
    public function index(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = Slide::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$slides = $query->orderByDesc('id')->paginate(10);

    	return view('slide.index', compact('slides'));
    }

    public function create()
    {
        return view('slide.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('slide', 'description');

        $validator = Validator::make($data, [
            'slide' => 'required',
            'description' => 'required|min:4',
        ], [
            'slide.required' => 'Slide is required',
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 4 characters',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->slide;
        $fileName = $request->file('slide')->storeAs('slide',time().'.jpg');
        $path = $file->move('slide', $fileName);
        $pathName = str_replace('\\', '/', $path);

        // dd($pathName);

        $slide = new Slide;

        $slide->slide = $pathName;
        $slide->description = $request->description;
        $slide->status = $request->status;
       
        $slide->save();

        $request->session()->flash('success', 'Add Success !');

        return redirect()->route('slides');
    }

    public function edit($id)
    {
        $slide = Slide::find($id);

        // dd($role);

        return view('slide.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('description', 'status');

        $validator = Validator::make($data, [
            'description' => 'required|min:4',
        ], [
            'description.required' => 'Description is required',
            'description.min' => 'Description is at least 4 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slide = Slide::find($id);

        $slide->description = $request->description;

        $slide->status = $request->status;

        $slide->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('slides');
    }

    public function destroy(Request $request, $id)
    {
        $slide = Slide::find($id);

        $slide->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('slides');
    }
}