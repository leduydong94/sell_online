<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use \Validator;

class RoleController extends Controller
{    
    public function role(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = Role::query();

    	if ($keyword) {
    		$query->where('name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$roles = $query->orderByDesc('id')->paginate(10);

    	return view('role.role', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('name');

        $validator = Validator::make($data, [
            'name' => 'required|min:4',
        ], [
            'name.required' => 'Role name is required',
            'name.min' => 'Role name is at least 4 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $roleName = Role::where('name', '=', "%{$name}%")->first();

        if ($roleName) {
            $request->session()->flash('existRole', 'Role already exists !');

            return redirect()->back()->withInput();
        }

        $role = new Role;

        $role->name = $name;

        $role->save();

        $request->session()->flash('success', 'Add Success !');

        return redirect()->route('roles');
    }

    public function edit($id)
    {
        $role = Role::find($id);

        // dd($role);

        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('name');

        $validator = Validator::make($data, [
            'name' => 'required|min:4',
        ], [
            'name.required' => 'Role name is required',
            'name.min' => 'Role name is at least 4 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->name;

        $roleName = Role::where('name', '=', "{$name}")->first();

        if ($roleName) {
            $request->session()->flash('existRole', 'Role already exists !');

            return redirect()->back()->withInput();
        }

        $role = Role::find($id);

        $role->name = $name;

        $role->save();

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('roles');
    }

    public function destroy(Request $request, $id)
    {
        $role = Role::find($id);

        $role->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('roles');
    }
}
