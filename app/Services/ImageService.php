<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageService
{
    /**
     * Store service
     */
    public function store(array $data)
    {
        if ($data['image']) {
            $file = $data['image'];
            $data['path_full'] = UploadService::upload($file, 'images');
            $data['path_thumb'] = UploadService::uploadThumb($file, 'images');
        }
        unset($data['image']);

        Auth::user()->images()->create($data);
    }

    /**
     * Update service
     */
    public function update(Image $image, array $data)
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
     * Unlink service
     */
    public function unlinkImages(Image $image)
    {
        if ($image->path_full !== null) {
            UploadService::unlink($image->path_full);
        }
        if ($image->path_thumb !== null) {
            UploadService::unlink($image->path_thumb);
        }
    }

    /**
     * Destroy service
     */
    public function destroy(Image $image)
    {
        $this->unlinkImages($image);

        $image->delete();
    }
}
