<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadService
{
    public static function upload(UploadedFile $file, $folder = null, $disk = 'public', $filename = null): String
    {
        $fileName = !is_null($filename) ? $filename : md5(uniqid());
        $fileExtension = $file->getClientOriginalExtension();
        $filePath = $folder . '/' . $fileName . '.' . $fileExtension;

        $image = Image::make($file)
            ->encode($fileExtension, 90);

        Storage::disk($disk)->put($filePath, $image);

        return Storage::url($filePath);
    }

    public static function uploadThumb(UploadedFile $file, $folder = null, $disk = 'public', $filename = null): String
    {
        $fileName = !is_null($filename) ? $filename : md5(uniqid());
        $fileExtension = $file->getClientOriginalExtension();
        $filePath = $folder . 'Thumbs/' . $fileName . '.' . $fileExtension;

        $image = Image::make($file)
            ->encode($fileExtension, 50);

        Storage::disk($disk)->put($filePath, $image);

        return Storage::url($filePath);
    }

    public static function unlink($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
