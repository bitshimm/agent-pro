<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Page;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{
	public function store($data)
	{
		if ($data['logotype']) {
			$file = $data['logotype'];
			$data['logotype'] = UploadService::upload($file, 'usersLogotypes');
		}

		if (Storage::disk('public')->exists('uploads/' . $data['name']) === false) {
			Storage::disk('public')->makeDirectory('uploads/' . $data['name']);
		}

		User::create($data);
	}

	public function update(Page $page, $data)
	{
		$page->update($data);
	}

	public function destroy(Page $page)
	{
		$page->delete();
	}
}
