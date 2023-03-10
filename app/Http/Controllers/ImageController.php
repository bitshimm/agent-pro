<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image as ImageManager;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Image\StoreRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class ImageController extends Controller
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $images = Image::orderBy('updated_at', 'desc')->get();

        return view('image.index', compact('images'));
    }

    public function create(): View
    {
        return view('image.create');
    }

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
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image): RedirectResponse
    {
        //
    }

    public function destroy(Image $image): RedirectResponse
    {
        // dd();
        unlink(public_path($image->path_full));
        
        $image->delete();

        return redirect()->route('images.index');
    }
}
