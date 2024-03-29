<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use App\Models\User;

class HandleInertiaRequests extends Middleware
{
	/**
	 * The root template that is loaded on the first page visit.
	 *
	 * @var string
	 */
	protected $rootView = 'app';

	/**
	 * Determine the current asset version.
	 */
	public function version(Request $request): string|null
	{
		return parent::version($request);
	}

	/**
	 * Define the props that are shared by default.
	 *
	 * @return array<string, mixed>
	 */
	public function share(Request $request): array
	{
		/**
		 * @var User $user
		 */
		$user = $request->user();

		$siteUrl = sprintf("%s://%s.%s", config('app.debug') ? 'http' : 'https',  $user ? $user->subdomain : '', config('app.domain'));

		return array_merge(parent::share($request), [
			'site' => [
				'url' => $siteUrl,
			],
			'auth' => [
				'user' => $user,
				'isAdmin' => $user ? $user->isAdmin() : false,
				'isManager' => $user ? $user->isManager() : false,
			],
			'ziggy' => function () use ($request) {
				return array_merge((new Ziggy)->toArray(), [
					'location' => $request->url(),
				]);
			},
			'flash' => [
				'message' => fn () => $request->session()->get('message'),
				'status' => fn () => $request->session()->get('status') ? $request->session()->get('status') : 'info',
			],
		]);
	}
}
