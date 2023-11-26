<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TinymceController extends Controller
{
    public function upload(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image',
        ]);

        $path = UploadService::upload($data['image'], 'uploads/' . Auth::user()->subdomain);

        return response()->json(['location' => $path]);
    }
}
