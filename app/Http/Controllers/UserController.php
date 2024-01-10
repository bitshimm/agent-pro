<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\AboutUpdateRequest;
use App\Http\Requests\User\ContactsUpdateRequest;
use App\Http\Requests\User\InformationUpdateRequest;
use App\Http\Requests\User\LogotypeUpdateRequest;
use App\Http\Requests\User\MetaUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest;
use App\Http\Requests\User\RoleUpdateRequest;
use App\Http\Requests\User\WidgetUpdateRequest;
use App\Http\Requests\User\SubdomainUpdateRequest;
use App\Models\Role;
use App\Models\SocialNetwork;
use App\Models\Theme;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\DomCrawler\Crawler;

class UserController extends Controller
{
	private UserService $userService;

	public function __construct(UserService $service)
	{
		$this->userService = $service;
	}

	/**
	 * Display a listing of the user's.
	 */
	public function index(): Response
	{
		$users = User::get();

		return Inertia::render('User/Index', [
			'users' => $users,
		]);
	}

	/**
	 * Show the form for creating a new user.
	 */
	public function create(): Response
	{
		return Inertia::render('User/Create');
	}

	/**
	 * Store a newly created user's.
	 */
	public function store(StoreRequest $storeRequest)
	{
		$data = $storeRequest->validated();

		$this->userService->store($data);

		return redirect()->route('users.index')->with('message', __('messages.user_created'))->with('status', 'success');
	}

	/**
	 * Show the form for editing the user's.
	 */
	public function edit(User $user)
	{
		$themes = Theme::select('themes.*')
			->join('users', 'users.id', '=', 'themes.user_id')
			->join('roles', 'roles.id', '=', 'users.role_id')
			->where('themes.user_id', $user->id)
			->orWhere('roles.slug', 'admin')
			->orWhere('roles.slug', 'manager')
			->get();

		return Inertia::render('User/Edit', [
			'user' => $user,
			'social_networks' => SocialNetwork::orderBy('id')->get(),
			'user_social_networks' => $user->socialNetworks,
			'themes' => $themes,
			'roles' => Role::orderBy('id')->get(),
		]);
	}

	public function roleUpdate(RoleUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$user->update($data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_role_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's subdomain.
	 */
	public function subdomainUpdate(SubdomainUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->subdomainUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_subdomain_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's information.
	 */
	public function informationUpdate(InformationUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$user->fill($data);

		if ($user->isDirty('email')) {
			$user->email_verified_at = null;
		}

		$user->save();

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_information_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's password.
	 */
	public function passwordUpdate(PasswordUpdateRequest $request, User $user): RedirectResponse
	{
		$validated = $request->validated();

		$request->user()->update([
			'password' => Hash::make($validated['password']),
		]);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_password_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's logotype.
	 */
	public function logotypeUpdate(LogotypeUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->logotypeUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_logotype_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's contacts.
	 */
	public function contactsUpdate(ContactsUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->contactsUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_contacts_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's social networks.
	 */
	public function socialNetworksUpdate(Request $request, User $user): RedirectResponse
	{
		$this->userService->socialNetworksUpdate($user, $request->user_social_networks);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_social_networks_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's widget.
	 */
	public function widgetUpdate(WidgetUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->widgetUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_widget_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's about information.
	 */
	public function aboutUpdate(AboutUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->aboutUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_about_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's meta information.
	 */
	public function metaUpdate(MetaUpdateRequest $request, User $user): RedirectResponse
	{
		$data = $request->validated();

		$this->userService->metaUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_meta_updated'))->with('status', 'success');
	}

	/**
	 * Remove the user's.
	 */
	public function destroy(User $user): RedirectResponse
	{
		$this->userService->destroy($user);

		return redirect()->route('users.index')->with('message', __('messages.user_deleted'))->with('status', 'success');
	}

	/**
	 * check website availability
	 */
	public function websiteAvailability(string $subdomain)
	{
		$hostname = sprintf("%s.%s", $subdomain, 'cruiselines.pro');
		$checkdnsrr = checkdnsrr($hostname, "A");
		if ($checkdnsrr)  {
			$content = @file_get_contents('https://' . $hostname);
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
				$pagesList = $crawler->filter('.navbar-nav .modal-dialog')->each(function (Crawler $node, $i): array {
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
					$about['desc'] = $aboutWrapper->filter('.modal-content .modal-body')->html();
				}
	
				/**
				 * Images
				 */
				$images = $crawler->filter('.photo-slider .photo-item')->each(function (Crawler $node, $i): string {
					return $node->filter('img')->attr('src');
				});
				$images = array_unique($images);
			}
			return response()->json([
				'status' => 'success',
				'data' => [
					'logotype' => $logotype,
					'pages' => $pagesList,
					'contacts' => $contacts,
					'socialNetworks' => $socialNetworks,
					'news' => $newsList,
					'specialOffersList' => $specialOffersList,
					'about' => $about,
					'images' => $images,
				],
			]);
		}
		return response()->json([
			'status' => 'error',
		]);
	}
}
