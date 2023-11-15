<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ArticleController extends Controller
{

	private ArticleService $articleService;

	public function __construct(ArticleService $service)
	{
		$this->articleService = $service;
	}

	public function index(): Response
	{
		$articles = Auth::user()->articles()->orderBy('id', 'desc')->paginate(7);

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

		$this->articleService->store($data);

		return redirect()->route('articles.index')->with('message', 'Новость создана')->with('status', 'success');
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

		$this->articleService->update($article, $data);

		return redirect()->route('articles.edit', ['article' => $article->id])->with('message', 'Новость обновлена')->with('status', 'success');
	}

	public function destroy(Article $article): RedirectResponse
	{
		$this->articleService->destroy($article);

		return redirect()->route('articles.index')->with('message', 'Новость удалена')->with('status', 'success');
	}
}
