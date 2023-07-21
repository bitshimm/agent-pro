<?php

namespace App\Services;

use App\Models\Article;
use App\Services\ImageService;

class ArticleService
{
    public function store($data)
    {
        // if ($data['image']) {
        //     $service = new ImageService;
        //     $data['image'] = $service->store($data);
        // }
        $data = Article::create($data);
    }

    public function update($article, $data)
    {
        $article->update($data);
    }
}
