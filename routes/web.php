<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TinymceController;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// return redirect()->route('articles.index');
	$url = "example.com";
	$dns = dns_get_record($url, DNS_A);

	if (!empty($dns)) {
		$content = @file_get_contents('https://' . $url);
		if ($content !== false) {
			$crawler = new Crawler($content);

			/**
			 * Logotype
			 */
			$logotype = $crawler->filter('.navbar .navbar-brand img');
			if ($logotype->count() > 0) {
				$logotype = $logotype->attr('src');
			} else {
				$logotype = '';
			}

			/**
			 * NavBar
			 */
			$navBarItemsList = $crawler->filter('.navbar-nav .modal-dialog')->each(function (Crawler $node, $i): array {
				return [
					'title' => $node->filter('.modal-title')->text(),
					'content' => $node->filter('.modal-body')->html(),
				];
			});

			/**
			 * Contacts
			 */
			$contacts = $crawler->filter('.contacts-head a')->each(function (Crawler $node, $i): array {
				$href = $node->attr('href');
				$type = '';
				if (stripos($href, 'tel:') !== false) {
					$href = str_replace('tel:', '', $href);
					$type = 'tel';
				} elseif (stripos($href, 'mailto:') !== false) {
					$href = str_replace('mailto:', '', $href);
					$type = 'mail';
				}
				return [
					'type' => $type,
					'value' => $href,
				];
			});

			/**
			 * SocialNetworks
			 */
			$socialNetworks = $crawler->filter('.f-contact-links-items .btn')->each(function (Crawler $node, $i): array {
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
				return [
					'type' => $type,
					'link' => $href,
				];
			});

			/**
			 * News
			 */
			$newsList = $crawler->filter('.news-item')->each(function (Crawler $node, $i): array {
				$modal = $node->filter('.modal-content');
				$createdAt = $node->filter('.news-head .news-date')->text();
				$createdAt = Carbon::createFromFormat('d/m/Y', $createdAt)->toDateTimeString();
				return [
					'created_at' => $createdAt,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $modal->filter('.modal-body')->html(),
				];
			});

			/**
			 * SpecialOffers
			 */
			$specialOffersList = $crawler->filter('.collapse-special-orders .btn-content-special-order')->each(function (Crawler $node, $i) use ($crawler): array {
				$btnTarget = $node->attr('data-bs-target');
				$image = $node->filter('img')->attr('src');
				$modal = $crawler->filter($btnTarget);
				return [
					'image' => $image,
					'title' => $modal->filter('.modal-title')->text(),
					'content' => $modal->filter('.modal-body')->html(),
				];
			});

			/**
			 * About
			 */
			$aboutWrapper = $crawler->filter('.decription-site');
			$about = [
				'title' => '',
				'short' => '',
				'desc' => '',
			];
			if ($aboutWrapper->count() > 0) {
				$about['title'] = $aboutWrapper->filter('.about-us-title')->text();
				$about['short'] = $aboutWrapper->filter('.text-white p')->text();
				$about['desc'] = $aboutWrapper->filter('.modal-content .modal-body')->text();
			}

			/**
			 * Images
			 */
			$images = $crawler->filter('.photo-slider .photo-item')->each(function (Crawler $node, $i): string {
				return $node->filter('img')->attr('src');
			});
			$images = array_unique($images);
		}
		$result = [
			'logotype' => $logotype,
			'navBar' => $navBarItemsList,
			'contacts' => $contacts,
			'socialNetworks' => $socialNetworks,
			'news' => $newsList,
			'specialOffersList' => $specialOffersList,
			'about' => $about,
			'images' => $images,
		];
		dd($result);
	}
})->name('home');

Route::middleware('auth')->group(function () {
	Route::group(['middleware' => 'role:admin,manager'], function () {
		Route::get('/users', [UserController::class, 'index'])->name('users.index');
		Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
		Route::post('/users', [UserController::class, 'store'])->name('users.store');
		Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
		Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

		Route::patch('/users/subdomain/{user}', [UserController::class, 'subdomainUpdate'])->name('users.subdomain.update');
		Route::patch('/users/information/{user}', [UserController::class, 'informationUpdate'])->name('users.information.update');
		Route::patch('/users/password/{user}', [UserController::class, 'passwordUpdate'])->name('users.password.update');
		Route::patch('/users/logotype/{user}', [UserController::class, 'logotypeUpdate'])->name('users.logotype.update');
		Route::patch('/users/contacts/{user}', [UserController::class, 'contactsUpdate'])->name('users.contacts.update');
		Route::patch('/users/social-networks/{user}', [UserController::class, 'socialNetworksUpdate'])->name('users.social-networks.update');
		Route::patch('/users/widget/{user}', [UserController::class, 'widgetUpdate'])->name('users.widget.update');
		Route::patch('/users/about/{user}', [UserController::class, 'aboutUpdate'])->name('users.about.update');
		Route::patch('/users/meta/{user}', [UserController::class, 'metaUpdate'])->name('users.meta.update');

		Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

		Route::group(['middleware' => 'role:admin'], function () {
			Route::patch('/users/role/{user}', [UserController::class, 'roleUpdate'])->name('users.role.update');

			Route::get('/social-networks', [SocialNetworkController::class, 'index'])->name('social-networks.index');
			Route::get('/social-networks/create', [SocialNetworkController::class, 'create'])->name('social-networks.create');
			Route::post('/social-networks', [SocialNetworkController::class, 'store'])->name('social-networks.store');
			Route::get('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'show'])->name('social-networks.show');
			Route::get('/social-networks/{socialNetwork}/edit', [SocialNetworkController::class, 'edit'])->name('social-networks.edit');
			Route::patch('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'update'])->name('social-networks.update');
			Route::delete('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'destroy'])->name('social-networks.destroy');

			Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
			Route::get('/themes/create', [ThemeController::class, 'create'])->name('themes.create');
			Route::post('/themes', [ThemeController::class, 'store'])->name('themes.store');
			Route::get('/themes/{theme}', [ThemeController::class, 'show'])->name('themes.show');
			Route::get('/themes/{theme}/edit', [ThemeController::class, 'edit'])->name('themes.edit');
			Route::patch('/themes/{theme}', [ThemeController::class, 'update'])->name('themes.update');
			// Route::delete('/themes/{theme}', [ThemeController::class, 'destroy'])->name('themes.destroy');
		});
	});

	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'informationUpdate'])->name('profile.information.update');
	Route::patch('/profile-theme', [ProfileController::class, 'themeUpdate'])->name('profile.theme.update');
	Route::patch('/profile-logotype', [ProfileController::class, 'logotypeUpdate'])->name('profile.logotype.update');
	Route::patch('/profile-social-networks', [ProfileController::class, 'socialNetworksUpdate'])->name('profile.social-networks.update');
	Route::patch('/profile-contacts', [ProfileController::class, 'contactsUpdate'])->name('profile.contacts.update');
	Route::patch('/profile-widget', [ProfileController::class, 'widgetUpdate'])->name('profile.widget.update');
	Route::patch('/profile-about', [ProfileController::class, 'aboutUpdate'])->name('profile.about.update');
	Route::patch('/profile-meta', [ProfileController::class, 'metaUpdate'])->name('profile.meta.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
	Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
	Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
	Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
	Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
	Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
	Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

	Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
	Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
	Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
	Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');
	Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
	Route::patch('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
	Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

	Route::get('/special-offers', [SpecialOfferController::class, 'index'])->name('special-offers.index');
	Route::get('/special-offers/create', [SpecialOfferController::class, 'create'])->name('special-offers.create');
	Route::post('/special-offers', [SpecialOfferController::class, 'store'])->name('special-offers.store');
	Route::get('/special-offers/{specialOffer}', [SpecialOfferController::class, 'show'])->name('special-offers.show');
	Route::get('/special-offers/{specialOffer}/edit', [SpecialOfferController::class, 'edit'])->name('special-offers.edit');
	Route::patch('/special-offers/{specialOffer}', [SpecialOfferController::class, 'update'])->name('special-offers.update');
	Route::delete('/special-offers/{specialOffer}', [SpecialOfferController::class, 'destroy'])->name('special-offers.destroy');

	Route::get('/images', [ImageController::class, 'index'])->name('images.index');
	Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
	Route::post('/images', [ImageController::class, 'store'])->name('images.store');
	Route::get('/images/{image}', [ImageController::class, 'show'])->name('images.show');
	Route::get('/images/{image}/edit', [ImageController::class, 'edit'])->name('images.edit');
	Route::patch('/images/{image}', [ImageController::class, 'update'])->name('images.update');
	Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

	Route::post('/tinymce-upload', [TinymceController::class, 'upload'])->name('tinymce.upload');

	Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager');

	Route::get('/site/publish', [SiteController::class, 'publish'])->name('site.publish');
	Route::get('/site/preview', [SiteController::class, 'preview'])->name('site.preview');
});

Route::post('/site/callbackForm', [SiteController::class, 'callbackForm']);

require __DIR__ . '/auth.php';
