<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Page;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;

class PageService
{
    public function store($data)
    {
        Auth::user()->pages()->create($data);
    }

    public function update(Page $page, $data)
    {
        $page->update($data);
    }

    public function destroy(Page $page)
    {
        $page->delete();
    }
}
