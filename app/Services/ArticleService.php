<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function store($data)
    {
        $data = Article::create($data);
    }

    public function update($article, $data)
    {
        $article->update($data);
    }
}
