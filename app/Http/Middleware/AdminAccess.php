<?php namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;

class AdminAccess {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::user()) {
			if (Auth::user()->role_id == User::ADMIN) {
				return $next($request);
			} else {
				return redirect()->guest('auth/login');
			}
		} else {
			return redirect()->guest('auth/login');
		}
	}

}
