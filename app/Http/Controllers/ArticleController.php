<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;

class ArticleController extends Controller
{

    private ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $articles = Article::where('visibility', '=', true)->orderBy('id', 'desc')->get();
        // $articles = Article::paginate(10);
        return (view('article.index', compact('articles'))->render());
    }

    public function create()
    {
        // $categories = Category::all();
        // $tags = Tag::all();

        return view('article.create');
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();

        $this->service->store($data);

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }


    public function edit(Article $article)
    {
        // $categories = Category::all();
        // $tags = Tag::all();

        return view('article.edit', compact('article'));
    }

    public function update(UpdateRequest $updateRequest, Article $article)
    {
        $data = $updateRequest->validated();

        $this->service->update($article, $data);

        return redirect()->route('articles.index');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
