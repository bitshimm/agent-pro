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
use App\Models\User;

class PageController extends Controller
{
	private PageService $pageService;

	public function __construct(PageService $service)
	{
		$this->pageService = $service;
	}

	public function index(): Response
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$pages = $user->pages()->orderBy('id', 'desc')->paginate(7);

		return Inertia::render('Page/Index', [
			'pages' => $pages,
		]);
	}

	public function create(): Response
	{
		return Inertia::render('Page/Create');
	}

	public function store(StoreRequest $storeRequest): RedirectResponse
	{
		$data = $storeRequest->validated();

		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$this->pageService->store($user, $data);

		return redirect()->route('pages.index')->with('message', __('messages.page_created'))->with('status', 'success');
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

		return redirect()->route('pages.edit', ['page' => $page->id])->with('message', __('messages.page_updated'))->with('status', 'success');
	}

	public function destroy(Page $page): RedirectResponse
	{
		$this->pageService->destroy($page);

		return redirect()->route('pages.index')->with('message', __('messages.page_deleted'))->with('status', 'success');
	}
}
