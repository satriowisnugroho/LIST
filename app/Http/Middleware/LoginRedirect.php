<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginRedirect {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = Auth::user();
		if (Auth::check()) {
	    	
	    	if ($user->role == 'admin') {

	            return redirect()->intended('/admin');

	    	} else if ($user->role == 'operator') {

	            return redirect()->intended('/operator');

	    	} else {

	            return redirect()->intended('/');

	    	}
	    	
		}
		return $next($request);
	}

}
