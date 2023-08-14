<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{

    private ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index(): Response
    {
        $articles = Auth::user()->articles()->orderBy('id', 'desc')->get();

        return Inertia::render('Article/Index', [
            'articles' => $articles,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Article/Create');
    }

    public function store(StoreRequest $storeRequest): RedirectResponse
    {
        $data = $storeRequest->validated();

        $this->service->store($data);

        return redirect()->route('articles.index');
    }

    public function show(Article $article): View
    {
        return view('article.show', compact('article'));
    }


    public function edit(Article $article): Response
    {
        return Inertia::render('Article/Edit', [
            'article' => $article,
        ]);
    }

    public function update(UpdateRequest $updateRequest, Article $article): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->service->update($article, $data);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->service->destroy($article);

        return redirect()->route('articles.index');
    }
}
