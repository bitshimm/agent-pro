<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\Image\StoreRequest;
use App\Http\Requests\Image\UpdateRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ImageController extends Controller
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function index(): Response
    {
        $images = Image::orderBy('id', 'desc')->get();
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

        $this->service->store($data);

        return redirect()->route('images.index');
    }

    public function tinymceUpload(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();

        $path = $this->service->uploadImage($data['image']);

        return response()->json(['location' => $path]);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Image $image): Response
    // {
    //     //
    // }

    public function edit(Image $image): Response
    {
        return Inertia::render('Image/Edit', [
            'image' => $image,
        ]);
    }

    public function update(UpdateRequest $updateRequest, Image $image): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->service->update($image, $data);

        return redirect()->route('images.index');
    }

    public function destroy(Image $image): RedirectResponse
    {
        $this->service->destroy($image);

        return redirect()->route('images.index');
    }
}
