<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SiteController extends Controller
{
	public string $host;
	public string $domain = "cruisel.pro";

	public function __construct()
	{
		$this->host = env("APP_HOST", "");
	}

	public function publish()
	{
		$host = $this->host;
		$domain = $this->domain;
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		if (!$user->subdomain) {
			back()->with('message', 'Не установлен поддомен')->with('status', 'error');
		}

		$articles = $user->articles()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();
		$pages = $user->pages()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();
		$specialOffers = $user->specialOffers()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();
		$images = $user->images()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();

		$html = view('publish.index', compact('user', 'articles', 'pages', 'specialOffers', 'images', 'host'))->render();

		Storage::disk('agent-sites')->put($user->subdomain . '.' . $this->domain .'/index.html', $html);

		return $html;
		return back()->with('message', 'Сайт опубликован')->with('status', 'success');
	}
}
