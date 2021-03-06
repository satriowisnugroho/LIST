<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class OperatorRoleRedirect {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if (Auth::user() == null || Auth::user()->role != 'operator') {
			return view('errors.503');
		}

		return $next($request);

	}

}
