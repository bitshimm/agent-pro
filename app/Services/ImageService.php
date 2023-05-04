<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;

class ImageService
{
    /**
     * Upload image service
     * @return string path file
     */
    public function uploadImage(\Illuminate\Http\UploadedFile $file): string
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = md5(uniqid()) . '.' . $fileExtension;

        $filePath = 'agents_images/' . $fileName;
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
        $data['path_thumb'] = $data['path_full'] = $this->uploadImage($data['image']) ;

        unset($data['image']);

        Image::create($data);

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
            unlink(public_path($image->path_full));
        }
        $image->update($data);
    }
}
