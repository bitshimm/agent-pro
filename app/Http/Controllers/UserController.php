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
		$hostname = sprintf("%s.%s", $subdomain, 'example.com');
		$url = sprintf("https://%s", $hostname);
		$checkdnsrr = checkdnsrr($hostname, "A");
		if ($checkdnsrr) {
			$content = @file_get_contents($url);
			if ($content !== false) {
				$crawler = new Crawler($content);

				return response()->json([
					'status' => 'success',
				]);
			}
		}

		return response()->json([
			'status' => 'error',
		]);
	}
}
