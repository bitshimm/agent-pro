<?php

namespace App\Http\Controllers;

use App\Models\User;
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
		
		/**
		 * @var User $user
		 */
		$user =  Auth::user();

		$path = UploadService::upload($data['image'], 'uploads/' . $user->subdomain);

		return response()->json(['location' => $path]);
	}
}
