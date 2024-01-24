<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Image;
use App\Models\Page;
use App\Models\SpecialOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Theme;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CallbackRequest;

class SiteService
{
	public string $appUrl;
	public string $home_page;
	public string $appDomain;

	public function __construct()
	{
		$this->appUrl = config('app.url');
		$this->appDomain = config('app.domain');

		if (config('app.debug')) {
			$this->home_page = "#";
		} else {
			$this->home_page = "/";
		}
	}

	public function publish(User $user)
	{
		if (!$user->subdomain) {
			return back()->with('message', __('messages.subdomain_isNull'))->with('status', 'error');
		}
		$html = $this->getPublishHtml($user);

		$folder = $user->subdomain . '.' . $this->appDomain;
		$pathToHtml = $folder . '/index.html';

		if (!Storage::disk('agent-sites')->exists($folder)) {
			Storage::disk('agent-sites')->makeDirectory($folder);
		}

		Storage::disk('agent-sites')->put($pathToHtml, $html);
	}

	public function checkDifference(User $user): bool
	{
		$html = $this->getPublishHtml($user);

		$folder = $user->subdomain . '.' . $this->appDomain;
		$pathToHtml = $folder . '/index.html';

		$currentHtml = Storage::disk('agent-sites')->get($pathToHtml);

		return $html == $currentHtml;
	}

	public function callbackForm(array $data)
	{
		$agent = User::where('subdomain', $data['subdomain'])->firstOrFail();

		Mail::to($agent->email)->send(new CallbackRequest($data['name'], $data['phone'], $agent->email, sprintf("%s.%s", $agent->subdomain, $this->appDomain)));
	}

	public function dnsExists($subdomain): bool
	{
		$hostname = sprintf("%s.%s", $subdomain, config('app.verified_domain'));
		$checkdnsrr = checkdnsrr($hostname, "A");

		return $checkdnsrr;
	}

	public function getPublishHtml(User $user): string
	{
		$url = $this->appUrl;
		$homePage = $this->home_page;
		$subdomain = $user->subdomain;
		$user->logotype = self::getLogotype($user);
		$theme = self::getTheme($user);
		$themeProperties = $theme ? $theme->properties : null;
		$articles = self::getArticles($user);
		$pages = self::getPages($user);
		$specialOffers = self::getSpecialOffers($user);
		$images = self::getImages($user);
		$html = view('site.publish', compact('homePage', 'user', 'articles', 'pages', 'specialOffers', 'images', 'url', 'theme', 'themeProperties', 'subdomain'))->render();
		return $html;
	}

	private function getTheme(User $user): mixed
	{
		/**
		 * @var Theme $theme
		 */
		$theme = $user->theme;

		if ($theme && $theme->background) {
			$theme->background = self::setImgCurrentUrl($theme->background);
		}
		return $theme;
	}

	private function getLogotype(User $user): string
	{
		if ($user->logotype) {
			return self::setImgCurrentUrl($user->logotype);
		}
		return '';
	}

	private function getArticles(User $user): Collection
	{
		return $user->articles()
			->where('active', 1)
			->orderBy('sort', 'desc')
			->latest()
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Article $item) {
				if ($item->image) $item->image = self::setImgCurrentUrl($item->image);
				if ($item->image_thumb) $item->image_thumb = self::setImgCurrentUrl($item->image_thumb);
				if ($item->content) $item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getPages(User $user): Collection
	{
		return $user->pages()
			->where('active', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Page $item) {
				if ($item->content) $item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getSpecialOffers(User $user): Collection
	{
		return $user->specialOffers()
			->where('active', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (SpecialOffer $item) {
				if ($item->image) $item->image = self::setImgCurrentUrl($item->image);
				if ($item->image_thumb) $item->image_thumb = self::setImgCurrentUrl($item->image_thumb);
				if ($item->content) $item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getImages(User $user): Collection
	{
		return $user->images()
			->where('active', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Image $item) {
				if ($item->path_full) $item->path_full = self::setImgCurrentUrl($item->path_full);
				if ($item->path_thumb) $item->path_thumb = self::setImgCurrentUrl($item->path_thumb);
				return $item;
			});
	}

	private function setImgCurrentUrl(string $string): string
	{
		return str_replace("/storage/", $this->appUrl . "/storage/", $string);
	}
}
