<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Validator;
use App\User;
use Session;
use Auth;
use Illuminate\Routing\UrlGenerator;

class AuthController extends Controller
{       
    public function register()
    {
    	return view('auth.register');
    }

    public function postRegister(Request $request)
    {
    	$data = $request->only('email', 'fullname', 'password', 'rePassword');

    	$validator = Validator::make($data, [
    		'email' => 'required|min:6',
    		'fullname' => 'required|min:5',
    		'password' => 'required|min:4',
    		'rePassword' => 'required|min:4'
    	], [
    		'email.required' => 'Email is required',
    		'email.min' => 'Email is at least 6 characters',
    		'fullname.required' => 'Fullname is required',
    		'fullname.min' => 'Fullname is at least 5 characters',
    		'password.required' => 'Password is required',
    		'password.min' => 'Password is at least 4 characters',
    		'rePassword.required' => 'Re password is required',
    		'rePassword.min' => 'Re password is at least 4 characters'
    	]);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	$email = $request->email;
    	$fullname = $request->fullname;
    	$password = $request->password;
    	$rePassword = $request->rePassword;
    	$role = $request->role;

    	// dd($role);

    	if ($password != $rePassword) {
    		$request->session()->flash('danger', 'Password does not match !');

    		return redirect()->back();
    	}

    	$user = new User;

    	$tmpUser = User::where('email', '=', "{$email}")->first();

    	if ($tmpUser) {
    		$request->session()->flash('duplicate', 'Email already exists !');

    		return redirect()->back();
    	}

    	$user->email = $email;
    	$user->full_name = $fullname;
    	$user->password = $password;

    	$user->save();

    	$user->roles()->attach($role);

    	$request->session()->put('successSignup', 'Sign Up Success !');

    	return redirect()->route('get-login');
    }

    public function login()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
    	$data = $request->only('email', 'password');

    	$validator = Validator::make($data, [
    		'email' => 'required|min:6',
     		'password' => 'required|min:4',
    	], [
    		'email.required' => 'Email is required',
    		'email.min' => 'Email is at least 6 characters',
    		'password.required' => 'Password is required',
    		'password.min' => 'Password is at least 4 characters'
    	]);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	}

    	$email = $request->email;
    	$password = $request->password;

    	$user = User::where('email', '=', "{$email}")->first();

    	if (!$user) {
    		$request->session()->flash('emailNotCorrect', 'Email is not correct !');

    		return redirect()->back();
    	} else {
    		$userPassword = $user->password;

    		if ($password != $userPassword) {
    		$request->session()->flash('passwordNotCorrect', 'Password is not correct !');

    		return redirect()->back();
    		}
		}

    	// $request->session()->put('user', $user);
        Auth::login($user);

    	return redirect()->route('index');
    }
}
