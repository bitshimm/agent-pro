<?php

namespace App\Services;

use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class SocialNetworkService
{
	public function store(array $data): void
	{
		SocialNetwork::create($data);
	}

	public function update(SocialNetwork $socialNetwork, array $data): void
	{
		$socialNetwork->update($data);
	}
}
