<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\Image\StoreRequest;
use App\Http\Requests\Image\UpdateRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
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
            // 'articles' => $articles,
        ]);
        // return view('image.index', compact('images'));
    }

    public function create(): View
    {
        return view('image.create');
    }

    public function tinymceUpload(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();

        $path = $this->service->store($data);

        return response()->json(['location' => $path]);
    }
    // public function store(StoreRequest $storeRequest)
    public function store(StoreRequest $storeRequest): RedirectResponse
    {
        $data = $storeRequest->validated();

        $this->service->store($data);

        return redirect()->route('images.index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Image $image): Response
    // {
    //     //
    // }

    public function edit(Image $image): View
    {
        return view('image.edit', compact('image'));
    }

    public function update(UpdateRequest $updateRequest, Image $image): RedirectResponse
    {
        $data = $updateRequest->validated();

        $this->service->update($image, $data);

        return redirect()->route('images.index');
    }

    public function destroy(Image $image): RedirectResponse
    {
        unlink(public_path($image->path_full));

        $image->delete();

        return redirect()->route('images.index');
    }
}
