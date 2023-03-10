<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image as ImageManager;

class ImageService
{
    private function uploadImage()
    {
        # code...
    }
    public function store($data)
    {
        $file = $data->file('image');
        dd($file);
        if ($file) {
            $this->uploadImage($file);
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = md5(uniqid()) . '.' . $fileExtension;

            $image = ImageManager::make($file)
                ->encode($fileExtension, 90);
            $thumb = $image->encode($fileExtension, 5);

            Storage::disk('public')->put('agents_images/' . $fileName, $image);
            Storage::disk('public')->put('agents_thumb_images/' . $fileName, $thumb);
        }
        $data = Image::create($data);
    }

    public function update($image, $data)
    {
        $image->update($data);
    }
}
