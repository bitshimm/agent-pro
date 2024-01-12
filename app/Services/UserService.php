<?php

namespace App\Services;

use App\Models\SocialNetwork;
use App\Models\User;
use App\Services\UploadService;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class UserService
{
	public function store(array $data): void
	{
		$transferData = false;
		if ($data['transfer_data']) {
			$transferData = true;
		}
		if (isset($data['transfer_data'])) unset($data['transfer_data']);

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

		if ($transferData) {
			$hostname = sprintf("%s.%s", $user->subdomain, config('app.verified_domain'));
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

	public function fillingUserReceivedData(User $user, string $hostname)
	{
		$url = sprintf("https://%s", $hostname);
		$content = @file_get_contents($url);
		if ($content !== false) {
			$crawler = new Crawler($content);

			$logotype = $crawler->filter('.navbar .navbar-brand img');
			if ($logotype->count() > 0) {
				$logotypeUrl = $logotype->attr('src');
				$logotypeUrlItems = explode('/', $logotypeUrl);
				$logotypeFileName = array_pop($logotypeUrlItems);
				$logotypeTempFilePath = 'tempImages/' . $logotypeFileName;
				Storage::disk('public')->put($logotypeTempFilePath, file_get_contents($url . $logotypeUrl));
				$dataLogotype['logotype'] = new UploadedFile(
					public_path(Storage::url($logotypeTempFilePath)),
					$logotypeFileName,
				);
				$this->logotypeUpdate($user, $dataLogotype);
				Storage::disk('public')->delete($logotypeTempFilePath);
			}

			$crawler->filter('.navbar-nav .modal-dialog')->each(function (Crawler $node, $i) use ($user): void {
				(new PageService)->store($user, [
					'title' => $node->filter('.modal-title')->text(),
					'content' => $node->filter('.modal-body')->html(),
					'sort' => 100,
					'active' => true,
				]);
			});

			$widgetObject = $crawler->filter('.filter-site .infoflotWidget');
			$widgetData = ['widget' => ''];
			if ($widgetObject->count() > 0) {
				$widgetData['widget'] = $widgetObject->outerHtml();
				$widgetData['widget'] .= $widgetObject->closest('.filter-site')->filter('script')->outerHtml();
				$this->widgetUpdate($user, $widgetData);
			}

			$userContacts = [
				'contact_phone' => '',
				'contact_phone_second' => '',
				'contact_email' => '',
				'contact_address' => '',
				'contact_opening_hours' => '',
			];
			$contactAddressObject  = $crawler->filter('.f-contact-item .fa-map-marker-alt');
			if ($contactAddressObject->count() > 0) {
				$userContacts['contact_address'] = $contactAddressObject->closest('.f-contact-item')->filter('span')->first()->text();
			}
			$contactEmailObject  = $crawler->filter('.f-contact-item .fa-envelope');
			if ($contactEmailObject->count() > 0) {
				$userContacts['contact_email'] = $contactEmailObject->closest('.f-contact-item')->filter('span')->text();
			}
			$contactPhoneObject  = $crawler->filter('.f-contact-item .fa-phone-alt');
			if ($contactPhoneObject->count() == 1) {
				$userContacts['contact_phone'] = $contactPhoneObject->first()->closest('.f-contact-item')->filter('span')->text();
			} else {
				$userContacts['contact_phone'] = $contactPhoneObject->first()->closest('.f-contact-item')->filter('span')->text();
				$userContacts['contact_phone_second'] = $contactPhoneObject->last()->closest('.f-contact-item')->filter('span')->text();
			}
			$contactOpeningHoursObject  = $crawler->filter('.f-contact-item .fa-clock');
			if ($contactOpeningHoursObject->count() > 0) {
				$userContacts['contact_opening_hours'] = $contactOpeningHoursObject->closest('.f-contact-item')->filter('span')->last()->text();
			}
			$this->contactsUpdate($user, $userContacts);


			$socialNetworksPluckedArray = SocialNetwork::get()->pluck('name', 'id')->all();
			$socialNetworksData = [];
			$crawler->filter('.f-contact-links-items .btn')->each(function (Crawler $node, $i) use (&$socialNetworksPluckedArray, &$socialNetworksData): void {
				$type = '';
				$href = $node->attr('href');
				$icon = $node->filter('i')->attr('class');
				if (stripos($icon, 'facebook') !== false) {
					$type = 'Facebook';
				} elseif (stripos($icon, 'fa-vk') !== false) {
					$type = 'Вконтакте';
				} elseif (stripos($icon, 'instagram') !== false) {
					$type = 'Instagram';
				} elseif (stripos($icon, 'twitter') !== false) {
					$type = 'Twitter';
				} elseif (stripos($icon, 'youtube') !== false) {
					$type = 'Youtube';
				} elseif (stripos($icon, 'odnoklassniki') !== false) {
					$type = 'Одноклассники';
				} elseif (stripos($icon, 'telegram') !== false) {
					$type = 'Telegram';
				}

				if (in_array($type, $socialNetworksPluckedArray)) {
					$socialNetworksData[array_search($type, $socialNetworksPluckedArray)] = $href;
				}
			});
			$this->socialNetworksUpdate($user, $socialNetworksData);

			$crawler->filter('.news-item')->each(function (Crawler $node, $i) use ($url, $user): void {
				$modal = $node->filter('.modal-content');
				$createdAt = $node->filter('.news-head .news-date')->text();
				$createdAt = Carbon::createFromFormat('d/m/Y', $createdAt)->toDateTimeString();
				$articleContent = trim($modal->filter('.modal-body')->html());
				$image = $modal->filter('img.news-data-img');
				$articleImage = '';
				$articleTempImagePath = '';
				if ($image->count() > 0 && $image->attr('src')) {
					$articleImageUrl = $image->attr('src');
					$articleUrlItems = explode('/', $articleImageUrl);
					$articleImageName = array_pop($articleUrlItems);
					$articleTempImagePath = 'tempImages/' . $articleImageName;
					Storage::disk('public')->put($articleTempImagePath, file_get_contents($url . $articleImageUrl));
					$articleImage = new UploadedFile(
						public_path(Storage::url($articleTempImagePath)),
						$articleImageName,
					);
					$articleContent = str_replace($image->closest('.text-center')->outerHtml(), "", $articleContent);
				}

				(new ArticleService)->store($user, [
					'created_at' => $createdAt,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $articleContent,
					'image' => $articleImage,
				]);

				if (Storage::disk('public')->exists($articleTempImagePath)) {
					Storage::disk('public')->delete($articleTempImagePath);
				}
			});

			$crawler->filter('.collapse-special-orders .btn-content-special-order')->each(function (Crawler $node, $i) use ($crawler, $url, $user): void {
				$btnTarget = $node->attr('data-bs-target');
				$image = $node->filter('img');
				$modal = $crawler->filter($btnTarget);
				$specialOfferImage = '';
				$specialOfferTempImagePath = '';
				if ($image->count() > 0) {
					$specialOfferImageUrl = $image->attr('src');
					$specialOfferUrlItems = explode('/', $specialOfferImageUrl);
					$specialOfferImageName = array_pop($specialOfferUrlItems);
					$specialOfferTempImagePath = 'tempImages/' . $specialOfferImageName;
					Storage::disk('public')->put($specialOfferTempImagePath, file_get_contents($url . $specialOfferImageUrl));
					$specialOfferImage = new UploadedFile(
						public_path(Storage::url($specialOfferTempImagePath)),
						$specialOfferImageName,
					);
				}

				(new SpecialOfferService())->store($user, [
					'image' => $specialOfferImage,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $modal->filter('.modal-body')->html(),
				]);

				if (Storage::disk('public')->exists($specialOfferTempImagePath)) {
					Storage::disk('public')->delete($specialOfferTempImagePath);
				}
			});

			$about = $crawler->filter('.decription-site');
			if ($about->count() > 0) {
				$this->aboutUpdate($user, [
					'about_title' => $about->filter('.about-us-title')->text(),
					'about_short_description' => $about->filter('.text-white p')->text(),
					'about_full_description' => $about->filter('.modal-content .modal-body')->html(),
				]);
			}

			$crawler->filter('.photo-slider .photo-item')->each(function (Crawler $node, $i) use ($url, $user): void {
				$image = '';
				$imageTempPath = '';
				$imageUrl = '';
				$imageUrl = $node->attr('href');
				$imageUrlItems = explode('/', $imageUrl);
				$imageName = array_pop($imageUrlItems);
				$imageTempPath = 'tempImages/' . $imageName;
				Storage::disk('public')->put($imageTempPath, file_get_contents($url . $imageUrl));

				$image = new UploadedFile(
					public_path(Storage::url($imageTempPath)),
					$imageName,
				);

				(new ImageService())->store($user, [
					'image' => $image,
					'sort' => 100,
					'active' => true,
				]);
			});
		}
	}
}
