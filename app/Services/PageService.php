<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Page;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;

class PageService
{
	public function store(array $data): void
	{
		Auth::user()->pages()->create($data);
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
