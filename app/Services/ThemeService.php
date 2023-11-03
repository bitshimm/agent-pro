<?php

namespace App\Services;

use App\Models\Theme;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;

class ThemeService
{
	public function store(array $data): void
	{
		if ($data['background']) {
			$file = $data['background'];
			$data['background'] = UploadService::upload($file, 'themesBackgrounds');
			$data['background_thumb'] = UploadService::uploadThumb($file, 'themesBackgrounds');
		}

		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$user->themes()->create($data);
	}

	public function update(Theme $theme, array $data): void
	{
		if ($data['background']) {
			$file = $data['background'];

			if ($theme->background !== null) {
				UploadService::unlink($theme->background);
			}
			if ($theme->background_thumb !== null) {
				UploadService::unlink($theme->background_thumb);
			}

			$data['background'] = UploadService::upload($file, 'themesBackgrounds');
			$data['background_thumb'] = UploadService::uploadThumb($file, 'themesBackgrounds');
		} else {
			unset($data['background']);
		}

		$theme->update($data);
	}
}
