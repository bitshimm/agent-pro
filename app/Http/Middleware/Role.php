<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class Role
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, ...$roles): Response
	{
		/**
		 * @var User
		 */
		$user = Auth::user();
		$userRole = $user->role()->pluck('slug')->first();
		if (in_array($userRole, $roles)) {
			return $next($request);
		}
		abort(403, "you don't have permission to access");
		return redirect(RouteServiceProvider::HOME);
	}
}
