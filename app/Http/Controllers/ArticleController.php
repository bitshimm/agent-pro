<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{

    private ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        // echo xdebug_info();
        $articles = Article::orderBy('id', 'desc')->get();

        // dump(\Illuminate\Support\Facades\Hash::make("Verg"));
        // sleep(3);
        // dump(\Illuminate\Support\Facades\Hash::make("Verg"));
        // dump(\Illuminate\Support\Facades\Hash::make("Dewd"));
        
        return view('article.index', compact('articles'));
    }

    public function create(): View
    {
        return view('article.create');
    }

    public function store(StoreRequest $storeRequest): RedirectResponse
    {
        $data = $storeRequest->validated();

        // dd($data);
        $this->service->store($data);

        return redirect()->route('articles.index');
    }

    public function show(Article $article): View
    {
        return view('article.show', compact('article'));
    }


    public function edit(Article $article): View
    {
        return view('article.edit', compact('article'));
    }

    public function update(UpdateRequest $updateRequest, Article $article): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->service->update($article, $data);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
