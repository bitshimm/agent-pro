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

class ThemeController extends Controller
{
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
			->orwhere('roles.slug', 'admin')
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

		if ($data['background']) {
			$file = $data['background'];
			$data['background'] = UploadService::upload($file, 'themesBackgrounds');
			$data['background_thumb'] = UploadService::uploadThumb($file, 'themesBackgrounds');
		}

		/**
		 * @var User $user
		 */
		$user = Auth::user();

		$user->themes()->create($data);

		return redirect()->route('themes.index')->with('message', 'Тема создана')->with('status', 'success');
	}

	/**
	 * Display the theme.
	 */
	// public function show(string $id)
	// {
	// 	//
	// }

	/**
	 * Show the form for editing the theme.
	 */
	public function edit(Theme $theme): Response
	{
		return Inertia::render('Theme/Edit', [
			'theme' => $theme,
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

		if ($data['background']) {
            $file = $data['background'];

			if ($theme->background !== null) {
				UploadService::unlink($theme->background);
			}
			if ($theme->background_thumb !== null) {
				UploadService::unlink($theme->background_thumb);
			}

            $data['background'] = UploadService::upload($file, 'themesBackgrounds');
            $data['background_thumb'] = UploadService::uploadThumb($file, 'themesBackgrounds');
        } else {
            unset($data['background']);
        }

		$theme->update($data);

		return redirect()->route('themes.edit', ['theme' => $theme->id])->with('message', 'Тема обновлена')->with('status', 'success');
	}

	/**
	 * Remove the theme from storage.
	 */
	// public function destroy(string $id)
	// {
	// 	
	// }
}
