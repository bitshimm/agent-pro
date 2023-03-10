<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image as ImageManager;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Image\StoreRequest;
use App\Services\ImageService;

class ImageController extends Controller
{
    private ImageService $service;

    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $images = Image::orderBy('updated_at', 'desc')->get();

        return view('image.index', compact('images'));
    }

    public function create()
    {
        return view('image.create');
    }

    public function store(StoreRequest $storeRequest)
    {
        $data = $storeRequest->validated();
        // dd($data);
        $this->service->store($data);
        // dd($data);
        // Storage::disk('public')->deleteDirectory('agents_images/');
        // Storage::disk('public')->deleteDirectory('agents_thumb_images/');
        $file = $storeRequest->file('image');
        if ($file) {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = md5(uniqid()) . '.' . $fileExtension;

            $image = ImageManager::make($file)
                ->encode($fileExtension, 90);
            $thumb = $image->encode($fileExtension, 5);

            Storage::disk('public')->put('agents_images/' . $fileName, $image);
            Storage::disk('public')->put('agents_thumb_images/' . $fileName, $thumb);
        }
        return redirect()->route('images.index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Image $image): Response
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Image $image): Response
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Image $image): RedirectResponse
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Image $image): RedirectResponse
    // {
    //     //
    // }
}
