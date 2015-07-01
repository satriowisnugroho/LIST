<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class MemberRoleRedirect {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (Auth::user() == null || Auth::user()->role != 'member') {
			return view('auth2.login')->withErrors('Anda harus login terlebih dahulu');
		}

		return $next($request);
		
	}

}
