<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\SocialNetwork;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

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

		return redirect()->route('users.index')->with('message', 'Пользователь создан')->with('status', 'success');
	}

	/**
	 * Show the form for editing the user's.
	 */
	public function edit(User $user)
	{
		return Inertia::render('User/Edit', [
			'user' => $user,
			'social_networks' => SocialNetwork::orderBy('id')->get(),
			'user_social_networks' => $user->socialNetworks,
		]);
	}

	/**
	 * Update the user's information.
	 */
	public function informationUpdate(Request $request, User $user): RedirectResponse
	{
		$user->fill($request->validate([
			'name' => ['string', 'max:255'],
			'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
		]));


		if ($user->isDirty('email')) {
			$user->email_verified_at = null;
		}

		$user->save();

		return Redirect::route('users.edit', $user->id)->with('message', 'Информация пользователя обновлена')->with('status', 'success');
	}

	/**
	 * Update the user's password.
	 */
	public function passwordUpdate(Request $request, User $user): RedirectResponse
	{
		$validated = $request->validate([
			'current_password' => ['required', 'current_password'],
			'password' => ['required', Password::defaults(), 'confirmed'],
		]);

		$request->user()->update([
			'password' => Hash::make($validated['password']),
		]);

		return Redirect::route('users.edit', $user->id)->with('message', 'Пароль пользователя обновлен')->with('status', 'success');
	}

	/**
	 * Update the user's logotype.
	 */
	public function logotypeUpdate(Request $request, User $user): RedirectResponse
	{
		$data = $request->validate([
			'logotype' => 'image|nullable',
		]);

		$this->userService->logotypeUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', 'Логотип пользователя обновлен')->with('status', 'success');
	}

	/**
	 * Update the user's contacts.
	 */
	function contactsUpdate(Request $request, User $user): RedirectResponse
	{
		$data = $request->validate([
			'contact_phone' => ['string', 'max:255', 'nullable'],
			'contact_phone_second' => ['string', 'max:255', 'nullable'],
			'contact_email' => ['email', 'max:255', 'nullable'],
			'contact_address' => ['string', 'max:255', 'nullable'],
			'contact_opening_hours' => ['string', 'max:255', 'nullable'],
		]);

		$this->userService->contactsUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', 'Контакты пользователя обновлены')->with('status', 'success');
	}

	/**
	 * Update the user's social networks.
	 */
	public function socialNetworksUpdate(Request $request, User $user): RedirectResponse
	{
		$this->userService->socialNetworksUpdate($user, $request->user_social_networks);

		return Redirect::route('users.edit', $user->id)->with('message', 'Социальные сети пользователя обновлены')->with('status', 'success');
	}

	/**
	 * Update the user's widget.
	 */
	public function widgetUpdate(Request $request, User $user): RedirectResponse
	{
		$data = $request->validate([
			'widget' => ['string', 'nullable'],
		]);

		$this->userService->widgetUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', 'Виджет пользователя обновлен')->with('status', 'success');
	}

	/**
	 * Update the user's about information.
	 */
	public function aboutUpdate(Request $request, User $user): RedirectResponse
	{
		$data = $request->validate([
			'about_title' => ['string', 'max:255', 'nullable'],
			'about_short_description' => ['string', 'nullable'],
			'about_full_description' => ['string', 'nullable'],
		]);

		$this->userService->aboutUpdate($user, $data);

		return Redirect::route('users.edit', $user->id)->with('message', '"О нас" пользователя обновлено')->with('status', 'success');
	}

	/**
	 * Remove the user's.
	 */
	public function destroy(User $user): RedirectResponse
	{
		$this->userService->destroy($user);

		return redirect()->route('users.index')->with('message', 'Пользователь удален')->with('status', 'success');
	}
}
