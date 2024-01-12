<?php

namespace App\Services;

use App\Models\Image;
use App\Models\User;

class ImageService
{
	/**
	 * Store service
	 */
	public function store(User $user, array $data): void
	{
		if ($data['image']) {
			$file = $data['image'];
			$data['path_full'] = UploadService::upload($file, 'images');
			$data['path_thumb'] = UploadService::uploadThumb($file, 'images');
		}
		unset($data['image']);

		$user->images()->create($data);
	}

	/**
	 * Update service
	 */
	public function update(Image $image, array $data): void
	{
		if ($data['image']) {
			$file = $data['image'];

			$this->unlinkImages($image);

			$data['path_full'] = UploadService::upload($file, 'images');
			$data['path_thumb'] = UploadService::uploadThumb($file, 'images');

			unset($data['image']);
		}
		$image->update($data);
	}

	/**
	 * Destroy service
	 */
	public function destroy(Image $image): void
	{
		$this->unlinkImages($image);

		$image->delete();
	}

	/**
	 * Unlink service
	 */
	public function unlinkImages(Image $image): void
	{
		if ($image->path_full !== null) {
			UploadService::unlink($image->path_full);
		}
		if ($image->path_thumb !== null) {
			UploadService::unlink($image->path_thumb);
		}
	}
}
