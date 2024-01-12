<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Services\ThemeService;

class ThemeController extends Controller
{
	private ThemeService $themeService;

	public function __construct(ThemeService $service)
	{
		$this->themeService = $service;
	}

	/**
	 * Display a listing of the themes.
	 */
	public function index(): Response
	{
		$user = Auth::user();
		$themes = Theme::select('themes.*')
			->join('users', 'users.id', '=', 'themes.user_id')
			->join('roles', 'roles.id', '=', 'users.role_id')
			->where('themes.user_id', $user->id)
			->orWhere('roles.slug', 'admin')
			->orWhere('roles.slug', 'manager')
			->get();

		return Inertia::render('Theme/Index', [
			'themes' => $themes,
			// 'defaulProperties' => $defaulProperties,
		]);
	}

	/**
	 * Show the form for creating a new theme.
	 */
	public function create(): Response
	{
		$properties = Theme::getPropertiesAliases();

		return Inertia::render('Theme/Create', [
			'properties' => $properties,
		]);
	}

	/**
	 * Store a newly created theme
	 */
	public function store(Request $request): RedirectResponse
	{
		$data = $request->validate([
			'name' => ['string', 'max:255', 'required'],
			'background' => ['image', 'required'],
			'properties' => [],
		]);

		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$this->themeService->store($user, $data);

		return redirect()->route('themes.index')->with('message', __('messages.theme_created'))->with('status', 'success');
	}

	/**
	 * Show the form for editing the theme.
	 */
	public function edit(Theme $theme): Response
	{
		/**
		 * @var User $user
		 */
		$user = Auth::user();

		return Inertia::render('Theme/Edit', [
			'theme' => $theme,
			'canEditTheme' => $theme->user->id === $user->id,
		]);
	}

	/**
	 * Update the theme in storage.
	 */
	public function update(Request $request, Theme $theme)
	{
		$data = $request->validate([
			'name' => ['string', 'max:255', 'required'],
			'background' => ['image', 'nullable'],
			'properties' => [],
		]);

		$this->themeService->update($theme, $data);

		return redirect()->route('themes.edit', ['theme' => $theme->id])->with('message', __('messages.theme_updated'))->with('status', 'success');
	}

	/**
	 * Remove the theme from storage.
	 */
	// public function destroy(string $id)
	// {
	// 	
	// }
}
