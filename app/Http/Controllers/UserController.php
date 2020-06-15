<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use \Validator;
use Auth;

class UserController extends Controller
{    
    public function index(Request $request)
    {
    	$keyword = $request->keyword;
    	
    	$query = User::query();

    	if ($keyword) {
    		$query->where('full_name', 'like', "%{$keyword}%")->paginate(10);
    	}

    	$users = $query->orderByDesc('id')->paginate(10);

    	return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
    	return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->only('fullname', 'email', 'password', 'roles');

        $validator = Validator::make($data, [
            'fullname' => 'required|min:5',
            'email' => 'required|min:6',
            'password' => 'required|min:4',
            'roles' => 'required'
        ], [
            'fullname.required' => 'Fullname is required',
            'fullname.min' => 'Fullname is at least 5 characters',
            'email.required' => 'Email is required',
            'email.min' => 'Email is at least 6 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password is at least 4 characters',
            'roles.required' => 'Roles is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;

        $email = $request->email;

        $roles = $request->roles;

        $emailUser = User::where('email', '=', "{$email}")->first();

        if ($emailUser) {
            $request->session()->flash('existEmail', 'Email already exists !');

            return redirect()->back()->withInput();
        }

        $user->full_name = $request->fullname;
        $user->email = $email;
        $user->password = $request->password;

        $user->save();

        $user->roles()->attach($roles);

        $request->session()->flash('success', 'Add Success !');

        return redirect()->route('users');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('fullname', 'roles');

        $validator = Validator::make($data, [
            'fullname' => 'required|min:5',
            'roles' => 'required'
        ], [
            'fullname.required' => 'Fullname is required',
            'fullname.min' => 'Fullname is at least 5 characters',
            'roles.required' => 'Roles is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $roles = $request->roles;

        $user = User::find($id);

        $user->full_name = $request->fullname;

        $user->save();

        $user->roles()->sync($roles);

        $request->session()->flash('success', 'Updated !');

        return redirect()->route('users');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        $user->delete();

        $request->session()->flash('success', 'Delete Success !');

        return redirect()->route('users');
    }

    public function changePassword($id)
    {
        $user = User::find($id);

        return view('user.changepassword', compact('user'));
    }

    public function postChangePassword(Request $request, $id)
    {
        $data = $request->only('oldPassword', 'newPassword', 'reNewPassword');

        $validator = Validator::make($data, [
            'oldPassword' => 'required|min:4',
            'newPassword' => 'required|min:4',
            'reNewPassword' => 'required|min:4',
        ], [
            'oldPassword.required' => 'Old Password is required',
            'oldPassword.min' => 'Old Password is at least 4 characters',
            'newPassword.required' => 'New Password is required',
            'newPassword.min' => 'New Password is at least 4 characters',
            'reNewPassword.required' => 'Retype New Password is required',
            'reNewPassword.min' => 'Retype New Password is at least 4 characters',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $oldPassword = $request->oldPassword;

        $newPassword = $request->newPassword;

        $reNewPassword = $request->reNewPassword;

        if ($newPassword != $reNewPassword) {
            $request->session()->flash('notmatch', 'Retype New Password not match !');

            return redirect()->back();
        }

        $user = User::find($id);

        if ($oldPassword != $user->password) {
            $request->session()->flash('danger', 'Old Password is not correct !');

            return redirect()->back();
        }

        $user->password = $newPassword;

        $user->save();

        $request->session()->flash('success', 'Change password successfully !');

        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('index');
    }
}
