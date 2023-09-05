<?php

namespace App\Services;

use App\Models\Page;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
	public function store($data): void
	{
		if ($data['logotype']) {
			$file = $data['logotype'];
			$data['logotype'] = UploadService::upload($file, 'usersLogotypes');
		}

		if (Storage::disk('public')->exists('uploads/' . $data['name']) === false) {
			Storage::disk('public')->makeDirectory('uploads/' . $data['name']);
		}

		$data['password'] = Hash::make($data['password']);

		User::create($data);
	}

	public function logotypeUpdate(User $user, array $data): void
	{
		if ($data['logotype']) {
			if ($user->logotype !== null) {
				UploadService::unlink($user->logotype);
			}
			$data['logotype'] = UploadService::upload($data['logotype'], 'logotypes');
		}
		$user->update($data);
	}

	public function contactsUpdate(User $user, array $data): void
	{
		if (isset($data['contact_phone'])) {
			$data['contact_phone'] = self::formatPhone($data['contact_phone']);
		}
		if (isset($data['contact_phone_second'])) {
			$data['contact_phone_second'] = self::formatPhone($data['contact_phone_second']);
		}

		$user->update($data);
	}

	public function socialNetworksUpdate(User $user, array $userSocialNetworks): void
	{
		foreach ($userSocialNetworks as $socialNetworkId => $socialNetworkLink) {
			if ($socialNetworkLink) {
				$userSocialNetworks[$socialNetworkId] = [
					'link' => $socialNetworkLink,
				];
			} else {
				unset($userSocialNetworks[$socialNetworkId]);
			}
		}

		$user->socialNetworks()->sync($userSocialNetworks);
	}

	public function widgetUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function aboutUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function destroy(User $user)
	{
		$user->delete();
	}

	public static function formatPhone(string $phone): string
	{
		return str_replace(['(', ')', '-'], '', $phone);
	}
}
