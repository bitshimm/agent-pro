<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Image;
use App\Models\Page;
use App\Models\SpecialOffer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SiteService
{
	public string $host;

	public function __construct()
	{
		$this->host = env("APP_HOST", "");
	}

	public function getPublishHtml(User $user): string {
		$host = $this->host;
		$user->logotype = self::getLogotype($user);
		$articles = self::getArticles($user);
		$pages = self::getPages($user);
		$specialOffers = self::getSpecialOffers($user);
		$images = self::getImages($user);
		$html = view('site.publish', compact('user', 'articles', 'pages', 'specialOffers', 'images', 'host'))->render();
		return $html;
	}

	private function getLogotype($user): string
	{
		return self::setImgCurrentUrl($user->logotype);
	}

	private function getArticles(User $user): Collection
	{
		return $user->articles()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Article $item) {
				$item->image = self::setImgCurrentUrl($item->image);
				$item->image_thumb = self::setImgCurrentUrl($item->image_thumb);
				$item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getPages(User $user): Collection
	{
		return $user->pages()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Page $item) {
				$item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getSpecialOffers(User $user): Collection
	{
		return $user->specialOffers()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (SpecialOffer $item) {
				$item->image = self::setImgCurrentUrl($item->image);
				$item->image_thumb = self::setImgCurrentUrl($item->image_thumb);
				$item->content = self::setImgCurrentUrl($item->content);
				return $item;
			});
	}

	private function getImages(User $user): Collection
	{
		return $user->images()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get()
			->transform(function (Image $item) {
				$item->path_full = self::setImgCurrentUrl($item->path_full);
				$item->path_thumb = self::setImgCurrentUrl($item->path_thumb);
				return $item;
			});
	}

	private function setImgCurrentUrl(string $string): string
	{
		return str_replace("/storage/", $this->host . "/storage/", $string);
	}
}
