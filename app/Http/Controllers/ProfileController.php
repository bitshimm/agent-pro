<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\AboutUpdateRequest;
use App\Http\Requests\Profile\ContactsUpdateRequest;
use App\Http\Requests\Profile\InformationUpdateRequest;
use App\Http\Requests\Profile\LogotypeUpdateRequest;
use App\Http\Requests\Profile\MetaUpdateRequest;
use App\Http\Requests\Profile\ThemeUpdateRequest;
use App\Http\Requests\Profile\WidgetUpdateRequest;
use App\Http\Requests\User\SubdomainUpdateRequest;
use App\Models\Role;
use App\Models\SocialNetwork;
use App\Models\Theme;
use App\Services\UserService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;


class ProfileController extends Controller
{
	private UserService $userService;

	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

	/**
	 * Display the user's profile form.
	 */
	public function edit(Request $request): Response
	{
		$user = $request->user();

		$themes = Theme::select('themes.*')
			->join('users', 'users.id', '=', 'themes.user_id')
			->join('roles', 'roles.id', '=', 'users.role_id')
			->where('themes.user_id', $user->id)
			->orWhere('roles.slug', 'admin')
			->orWhere('roles.slug', 'manager')
			->get();

		return Inertia::render('Profile/Edit', [
			'mustVerifyEmail' => $user instanceof MustVerifyEmail,
			'status' => session('status'),
			'social_networks' => SocialNetwork::orderBy('id')->get(),
			'user_social_networks' => $user->socialNetworks,
			'user' => $user,
			'themes' => $themes,
			'roles' => Role::orderBy('id')->get(),
		]);
	}

	/**
	 * Update the user's profile subdomain.
	 */
	public function subdomainUpdate(SubdomainUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();
		
		$this->userService->subdomainUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', __('messages.user_subdomain_updated'))->with('status', 'success');
	}

	/**
	 * Update the user's profile information.
	 */
	public function informationUpdate(InformationUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit')->with('message', __('messages.information_updated'))->with('status', 'success');;
	}

	/**
	 * Delete the user's account.
	 */
	public function destroy(Request $request): RedirectResponse
	{
		$request->validate([
			'password' => ['required', 'current_password'],
		]);

		$user = $request->user();

		Auth::logout();

		$user->delete();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return Redirect::to('/');
	}

	public function themeUpdate(ThemeUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$user->update($data);

		return Redirect::route('profile.edit')->with('message', __('messages.theme_updated'))->with('status', 'success');
	}

	public function logotypeUpdate(LogotypeUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$this->userService->logotypeUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', __('messages.logotype_updated'))->with('status', 'success');
	}

	public function socialNetworksUpdate(Request $request): RedirectResponse
	{
		$user = $request->user();

		$this->userService->socialNetworksUpdate($user, $request->user_social_networks);

		return Redirect::route('profile.edit')->with('message', __('messages.social_networks_updated'))->with('status', 'success');
	}

	public function widgetUpdate(WidgetUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$this->userService->widgetUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', __('messages.widget_updated'))->with('status', 'success');
	}

	public function contactsUpdate(ContactsUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$this->userService->contactsUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', __('messages.contacts_updated'))->with('status', 'success');
	}

	public function aboutUpdate(AboutUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$this->userService->aboutUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', __('messages.about_updated'))->with('status', 'success');
	}

	public function metaUpdate(MetaUpdateRequest $request): RedirectResponse
	{
		$data = $request->validated();

		$user = $request->user();

		$this->userService->metaUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', __('messages.meta_updated'))->with('status', 'success');
	}
}
