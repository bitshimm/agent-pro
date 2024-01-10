<?php

namespace App\Services;

use App\Models\User;
use App\Services\UploadService;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class UserService
{
	private $crawler;

	public function store(array $data): void
	{
		if ($data['logotype']) {
			$file = $data['logotype'];
			$data['logotype'] = UploadService::upload($file, 'usersLogotypes');
		}

		if (Storage::disk('public')->exists('uploads/' . $data['subdomain']) === false) {
			Storage::disk('public')->makeDirectory('uploads/' . $data['subdomain']);
		}

		$data['password'] = Hash::make($data['password']);

		/**
		 * @var User $user
		 */
		$user = User::create($data);

		$hostname = sprintf("%s.%s", $user->subdomain, 'cruiselines.pro');
		if (checkdnsrr($hostname, "A")) {
			self::fillingUserReceivedData($user, $hostname);
		}
	}

	public function subdomainUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function logotypeUpdate(User $user, array $data): void
	{
		if ($data['logotype']) {
			if ($user->logotype !== null) {
				UploadService::unlink($user->logotype);
			}
			$data['logotype'] = UploadService::upload($data['logotype'], 'logotypes');
		}
		$user->update($data);
	}

	public function contactsUpdate(User $user, array $data): void
	{
		if (isset($data['contact_phone'])) {
			$data['contact_phone'] = self::formatPhone($data['contact_phone']);
		}
		if (isset($data['contact_phone_second'])) {
			$data['contact_phone_second'] = self::formatPhone($data['contact_phone_second']);
		}

		$user->update($data);
	}

	public function socialNetworksUpdate(User $user, array $userSocialNetworks): void
	{
		foreach ($userSocialNetworks as $socialNetworkId => $socialNetworkLink) {
			if ($socialNetworkLink) {
				$userSocialNetworks[$socialNetworkId] = [
					'link' => $socialNetworkLink,
				];
			} else {
				unset($userSocialNetworks[$socialNetworkId]);
			}
		}

		$user->socialNetworks()->sync($userSocialNetworks);
	}

	public function widgetUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function aboutUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function metaUpdate(User $user, array $data): void
	{
		$user->update($data);
	}

	public function destroy(User $user)
	{
		$user->delete();
	}

	public static function formatPhone(string $phone): string
	{
		return str_replace(['(', ')', '-'], '', $phone);
	}

	public static function fillingUserReceivedData(User $user, string $hostname)
	{
		$url = sprintf("https://%s", $hostname);
		$content = @file_get_contents($url);
		if ($content !== false) {
			$data = [];
			$crawler = new Crawler($content);

			$logotype = $crawler->filter('.navbar .navbar-brand img');
			if ($logotype->count() > 0) {
				$logotypeUrl = $logotype->attr('src');
				$logotypeUrlItems = explode('/', $logotypeUrl);
				$dataLogotype['logotype'] = new UploadedFile(
					$url . $logotypeUrl,
					array_pop($logotypeUrlItems),
				);
				self::logotypeUpdate($user, $dataLogotype);
			}

			$pagesList = $crawler->filter('.navbar-nav .modal-dialog')->each(function (Crawler $node, $i): array {
				return [
					'title' => $node->filter('.modal-title')->text(),
					'content' => $node->filter('.modal-body')->html(),
					'sort' => 100,
					'active' => true,
				];
			});
			foreach ($pagesList as $page) {
				(new PageService)->store($user, $page);
			}

			$articlesList = $crawler->filter('.news-item')->each(function (Crawler $node, $i) use ($url): array {
				$modal = $node->filter('.modal-content');
				$createdAt = $node->filter('.news-head .news-date')->text();
				$createdAt = Carbon::createFromFormat('d/m/Y', $createdAt)->toDateTimeString();
				$image = $node->filter('.news-head img');
				$articleImage = '';
				if ($image->count() > 0) {
					$articleImageUrl = $image->attr('src');
					$articleUrlItems = explode('/', $articleImageUrl);
					$articleImageName = array_pop($articleUrlItems);
					Storage::put('tempImages/' . $articleImageName, file_get_contents($url . $articleImageUrl));
					$articleImageTempFile = Storage::get('tempImages/' . $articleImageName);
					$articleImage = new UploadedFile(
						$articleImageTempFile,
						$articleImageName,
					);
				}
				return [
					'created_at' => $createdAt,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $modal->filter('.modal-body')->html(),
					'image' => $articleImage,
				];
			});
			foreach ($articlesList as $article) {
				(new ArticleService)->store($user, $article);
			}

			$specialOffersList = $crawler->filter('.collapse-special-orders .btn-content-special-order')->each(function (Crawler $node, $i) use ($crawler, $url): array {
				$btnTarget = $node->attr('data-bs-target');
				$image = $node->filter('img');
				$modal = $crawler->filter($btnTarget);
				$specialOfferImage = '';
				if ($image->count() > 0) {
					$specialOfferImageUrl = $image->attr('src');
					$specialOfferUrlItems = explode('/', $specialOfferImageUrl);
					$specialOfferImage = new UploadedFile(
						$url . $specialOfferImageUrl,
						array_pop($specialOfferUrlItems),
					);
				}
				return [
					'image' => $specialOfferImage,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $modal->filter('.modal-body')->html(),
				];
			});
			foreach ($specialOffersList as $specialOffer) {
				(new SpecialOfferService())->store($user, $specialOffer);
			}

			$about = $crawler->filter('.decription-site');
			if ($about->count() > 0) {
				self::logotypeUpdate($user, [
					'about_title' => $about->filter('.about-us-title')->text(),
					'about_short_description' => $about->filter('.text-white p')->text(),
					'about_full_description' => $about->filter('.modal-content .modal-body')->html(),
				]);
			}

			$imagesList = $crawler->filter('.photo-slider .photo-item')->each(function (Crawler $node, $i) use ($url): array {
				$image = $node->filter('img');
				$imgImage = '';
				if ($image->count() > 0) {
					$imgImageUrl = $image->attr('src');
					$imgUrlItems = explode('/', $imgImageUrl);
					$imgImage = new UploadedFile(
						$url . $imgImageUrl,
						array_pop($imgUrlItems),
					);
				}
				return [
					'image' => $imgImage,
					'sort' => 100,
					'active' => true,
				];
			});
			$imagesList = array_unique($imagesList);
			foreach ($imagesList as $image) {
				(new ImageService())->store($user, $image);
			}
		}
	}
}
