<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    private PageService $pageService;

	public function __construct(PageService $service)
	{
		$this->pageService = $service;
	}

	public function index() : Response {
		$pages = Auth::user()->pages()->orderBy('id', 'desc')->get();

		return Inertia::render('Page/Index', [
			'pages' => $pages,
		]);
	}

	public function create() : Response {
		return Inertia::render('Page/Create');
	}

	public function store(StoreRequest $storeRequest) : RedirectResponse {
		$data = $storeRequest->validated();

		$this->pageService->store($data);

		return redirect()->route('pages.index')->with('message', 'Страница создана')->with('status', 'success');
	}

	public function show(Page $page): View
    {
        return view('page.show', compact('page'));
    }

	public function edit(Page $page): Response
    {
        return Inertia::render('Page/Edit', [
            'page' => $page,
        ]);
    }

	public function update(UpdateRequest $updateRequest, Page $page): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->pageService->update($page, $data);

        return redirect()->route('pages.edit', ['page' => $page->id])->with('message', 'Страница обновлена')->with('status', 'success');
    }

	public function destroy(Page $page): RedirectResponse
    {
        $this->pageService->destroy($page);

        return redirect()->route('pages.index')->with('message', 'Страница удалена')->with('status', 'success');
    }
}
