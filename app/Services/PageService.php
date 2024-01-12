<?php

namespace App\Services;

use App\Models\Page;
use App\Models\User;

class PageService
{
	public function store(User $user, array $data): void
	{
		$user->pages()->create($data);
	}

	public function update(Page $page, array $data): void
	{
		$page->update($data);
	}

	public function destroy(Page $page): void
	{
		$page->delete();
	}
}
