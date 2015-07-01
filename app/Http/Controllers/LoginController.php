<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User as User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller {

	public function index() 
	{
		return view('auth2.login');
	}

	public function postLogin(LoginRequest $request) 
	{
		$email = \Request::input('email');
		$password = \Request::input('password');
		
		if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
        	$user = Auth::user();
        	if ($user->role == 'admin') {

	            return redirect()->intended('/admin');

        	} else if ($user->role == 'operator') {

	            return redirect()->intended('/operator');

        	} else {

	            return redirect()->intended('/');

        	}
        } else {
        	return redirect('/login')->with('errorMessage', 'Kombinasi email dan password salah.');
        }

	}

	public function getLogout()
	{
		Auth::logout();

		return redirect('/');
	}

}
