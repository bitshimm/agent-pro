<?php

namespace App\Http;

use Alexusmai\LaravelFileManager\Services\ACLService\ACLRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersACLRepository implements ACLRepository
{
	/**
	 * Get user ID
	 *
	 * @return mixed
	 */
	public function getUserID()
	{
		return Auth::id();
	}

	/**
	 * Get ACL rules list for user
	 *
	 * @return array
	 */
	public function getRules(): array
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();
		$userRole = $user->role()->pluck('slug')->first();

		/**
		 * Пока ограничу доступ для "админов"
		 */
		if (in_array($userRole, ['admin'])) {
			return [
				['disk' => 'public', 'path' => '*', 'access' => 2],
			];
		}

		return [
			['disk' => 'public', 'path' => '/', 'access' => 1],                                  // main folder - read
			['disk' => 'public', 'path' => 'uploads', 'access' => 1],                              // only read
			['disk' => 'public', 'path' => 'uploads/' . Auth::user()->subdomain, 'access' => 1],        // only read
			['disk' => 'public', 'path' => 'uploads/' . Auth::user()->subdomain . '/*', 'access' => 2],  // read and write
		];
	}
}
