<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;

class ImageService
{
    /**
     * Upload image service
     * @return string path file
     */
    public function uploadImage(\Illuminate\Http\UploadedFile $file, $path = 'images/'): string
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = md5(uniqid()) . '.' . $fileExtension;

        $filePath = $path . $fileName;
        $image = ImageManager::make($file)
            ->encode($fileExtension, 90);

        Storage::disk('public')->put($filePath, $image);

        return Storage::url($filePath);
    }

    /**
     * Store service
     */
    public function store(array $data)
    {
        $data['path_thumb'] = $data['path_full'] = $this->uploadImage($data['image']);

        unset($data['image']);

        Auth::user()->images()->create($data);

        return $data['path_full'];
    }

    /**
     * Update service
     */
    public function update(Image $image, array $data)
    {
        if ($data['image']) {
            $data['path_thumb'] = $data['path_full'] = $this->uploadImage($data['image']);
            unset($data['image']);
            if (file_exists(public_path($image->path_full))) {
                unlink(public_path($image->path_full));
            }
        }
        $image->update($data);
    }

    /**
     * Unlink service
     */
    public function unlinkImage(string $path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    /**
     * Destroy service
     */
    public function destroy(Image $image)
    {
        $this->unlinkImage($image->path_full);

        $image->delete();
    }
}
