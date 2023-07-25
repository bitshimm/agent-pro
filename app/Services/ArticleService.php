<?php

namespace App\Services;

use App\Models\Article;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function store($data)
    {
        if ($data['image']) {
            $service = new ImageService;
            $data['image'] = $service->uploadImage($data['image']);
        }
        $data = Auth::user()->articles()->create($data);
    }

    public function update($article, $data)
    {

        if ($data['new_image']) {
            $service = new ImageService;
            if ($data['image'] !== null) {
                $service->unlinkImage($data['image']);
            }
            $data['image'] = $service->uploadImage($data['new_image']);
        }
        $article->update($data);
    }
}
