<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\Image\StoreRequest;
use App\Http\Requests\Image\UpdateRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ImageController extends Controller
{
	private ImageService $imageService;

	public function __construct(ImageService $service)
	{
		$this->imageService = $service;
	}

	public function index(): Response
	{
		$images = Auth::user()->images()->orderBy('id', 'desc')->get();

		return Inertia::render('Image/Index', [
			'images' => $images,
		]);
	}

	public function create(): Response
	{
		return Inertia::render('Image/Create');
	}

	public function store(StoreRequest $storeRequest): RedirectResponse
	{
		$data = $storeRequest->validated();

		$this->imageService->store($data);

		return redirect()->route('images.index')->with('message', __('messages.image_created'))->with('status', 'success');
	}

	public function edit(Image $image): Response
	{
		return Inertia::render('Image/Edit', [
			'image' => $image,
		]);
	}

	public function update(UpdateRequest $updateRequest, Image $image): RedirectResponse
	{
		$data = $updateRequest->validated();

		$this->imageService->update($image, $data);

		return redirect()->route('images.edit', ['image' => $image->id])->with('message', __('messages.image_updated'))->with('status', 'success');
	}

	public function destroy(Image $image): RedirectResponse
	{
		$this->imageService->destroy($image);

		return redirect()->route('images.index')->with('message', __('messages.image_deleted'))->with('status', 'success');
	}
}
