<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageManager;

class ImageService
{
    public function uploadImage(\Illuminate\Http\UploadedFile $file)
    {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = md5(uniqid()) . '.' . $fileExtension;

        $filePath = 'agents_images/' . $fileName;
        $image = ImageManager::make($file)
            ->encode($fileExtension, 90);

        Storage::disk('public')->put($filePath, $image);

        return Storage::url($filePath);
    }
    
    public function store($data)
    {
        $data['path_thumb'] = $data['path_full'] = $this->uploadImage($data['image']);

        unset($data['image']);

        Image::create($data);
    }

    public function update($image, $data)
    {
        $image->update($data);
    }
}
