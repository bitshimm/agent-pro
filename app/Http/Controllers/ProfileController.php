<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
use Illuminate\Support\Facades\Mail;

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
			->orwhere('roles.slug', 'admin')
			->get();

		return Inertia::render('Profile/Edit', [
			'mustVerifyEmail' => $user instanceof MustVerifyEmail,
			'status' => session('status'),
			'social_networks' => SocialNetwork::orderBy('id')->get(),
			'user_social_networks' => $user->socialNetworks,
			'user' => $user,
			'themes' => $themes,
		]);
	}

	/**
	 * Update the user's profile information.
	 */
	public function update(ProfileUpdateRequest $request): RedirectResponse
	{
		$request->user()->fill($request->validated());

		if ($request->user()->isDirty('email')) {
			$request->user()->email_verified_at = null;
		}

		$request->user()->save();

		return Redirect::route('profile.edit');
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

	public function sendmail()
	{
		Mail::raw('Hello World!', function ($msg) {
			$msg->to('b.shiman@flotconsult.ru')->subject('Test Email');
		});
		return 'success';
	}

	public function themeUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'theme_id' => ['integer', 'exists:themes,id'],
		]);

		$user = $request->user();

		$user->update($data);

		return Redirect::route('profile.edit')->with('message', 'Тема обновлена')->with('status', 'success');
	}

	public function logotypeUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'logotype' => 'image|nullable',
		]);

		$user = $request->user();

		$this->userService->logotypeUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', 'Логотип обновлен')->with('status', 'success');
	}

	public function socialNetworksUpdate(Request $request): RedirectResponse
	{
		$user = $request->user();

		$this->userService->socialNetworksUpdate($user, $request->user_social_networks);

		return Redirect::route('profile.edit')->with('message', 'Социальные сети обновлены')->with('status', 'success');
	}

	public function widgetUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'widget' => ['string', 'nullable'],
		]);

		$user = $request->user();

		$this->userService->widgetUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', 'Виджет обновлен')->with('status', 'success');
	}

	public function contactsUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'contact_phone' => ['string', 'max:255', 'nullable'],
			'contact_phone_second' => ['string', 'max:255', 'nullable'],
			'contact_email' => ['email', 'max:255', 'nullable'],
			'contact_address' => ['string', 'max:255', 'nullable'],
			'contact_opening_hours' => ['string', 'max:255', 'nullable'],
		]);

		$user = $request->user();

		$this->userService->contactsUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', 'Контакты обновлены')->with('status', 'success');
	}

	public function aboutUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'about_title' => ['string', 'max:255', 'nullable'],
			'about_short_description' => ['string', 'nullable'],
			'about_full_description' => ['string', 'nullable'],
		]);

		$user = $request->user();

		$this->userService->aboutUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', '"О нас" обновлено')->with('status', 'success');
	}

	public function metaUpdate(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'meta_title' => ['string', 'max:255', 'nullable'],
			'meta_description' => ['string', 'max:255', 'nullable'],
		]);

		$user = $request->user();

		$this->userService->metaUpdate($user, $data);

		return Redirect::route('profile.edit')->with('message', 'Meta информация обновлена')->with('status', 'success');
	}
}
