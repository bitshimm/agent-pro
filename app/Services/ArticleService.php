<?php

namespace App\Services;

use App\Models\Article;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function store($data)
    {
        if ($data['image']) {
            $file = $data['image'];
            $data['image'] = UploadService::upload($file, 'articleImages');
            $data['image_thumb'] = UploadService::uploadThumb($file, 'articleImages');
        }

        Auth::user()->articles()->create($data);
    }

    public function update(Article $article, $data)
    {
        if ($data['image']) {
            $file = $data['image'];

            $this->unlinkArticleImages($article);

            $data['image'] = UploadService::upload($file, 'articleImages');
            $data['image_thumb'] = UploadService::uploadThumb($file, 'articleImages');
        } else {
            unset($data['image']);
        }
        $article->update($data);
    }

    public function destroy(Article $article)
    {
        $this->unlinkArticleImages($article);

        $article->delete();
    }

    private function unlinkArticleImages(Article $article)
    {
        if ($article->image !== null) {
            UploadService::unlink($article->image);
        }
        if ($article->image_thumb !== null) {
            UploadService::unlink($article->image_thumb);
        }
    }
}
