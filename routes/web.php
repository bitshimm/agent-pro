<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SocialNetworkController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\TinymceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
	return redirect()->route('articles.index');
})->name('home');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::patch('/profile-social-networks', [ProfileController::class, 'socialNetworksUpdate'])->name('profile.social-networks.update');
	Route::patch('/profile-contacts', [ProfileController::class, 'contactsUpdate'])->name('profile.contacts.update');
	Route::patch('/profile-widget', [ProfileController::class, 'widgetUpdate'])->name('profile.widget.update');
	Route::patch('/profile-about', [ProfileController::class, 'aboutUpdate'])->name('profile.about.update');
	Route::patch('/profile-logotype', [ProfileController::class, 'logotypeUpdate'])->name('profile.logotype.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
	Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

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

	Route::get('/social-networks', [SocialNetworkController::class, 'index'])->name('social-networks.index');
	Route::get('/social-networks/create', [SocialNetworkController::class, 'create'])->name('social-networks.create');
	Route::post('/social-networks', [SocialNetworkController::class, 'store'])->name('social-networks.store');
	Route::get('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'show'])->name('social-networks.show');
	Route::get('/social-networks/{socialNetwork}/edit', [SocialNetworkController::class, 'edit'])->name('social-networks.edit');
	Route::patch('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'update'])->name('social-networks.update');
	Route::delete('/social-networks/{socialNetwork}', [SocialNetworkController::class, 'destroy'])->name('social-networks.destroy');


	Route::post('/tinymce-upload', [TinymceController::class, 'upload'])->name('tinymce.upload');

	Route::get('filemanager', [FileManagerController::class, 'index'])->name('filemanager');
	Route::get('sendmail', [ProfileController::class, 'sendmail'])->name('sendmail');
	Route::get('/publish', function (Request $request) {
		$user = Auth::user();
		// dd($user->socialNetworks);
		$articles = $user->articles()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();
		return $finalHtml = view('publish.index', compact('user', 'articles'))->render();
		// return Storage::disk('agent-sites')->put( $user->name . '/index.html', $finalHtml);
	})->name('publish');
	Route::get('/preview', function () {
		$user = Auth::user();
		$articles = $user->articles()
			->where('visibility', 1)
			->orderBy('sort', 'desc')
			->orderBy('created_at', 'desc')
			->get();
		return $finalHtml = view('publish.index', compact('user', 'articles'))->render();
		// return Storage::disk('agent-sites')->put( $user->name . '/index.html', $finalHtml);
	})->name('preview');
});
require __DIR__ . '/auth.php';
