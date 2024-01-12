<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Image;
use App\Models\Page;
use App\Models\Role;
use App\Models\SpecialOffer;
use App\Models\Theme;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			SocialNetworkSeeder::class,
		]);

		$agentRole = Role::create(['name' => 'Агент', 'slug' => 'agent']);
		$managerRole = Role::create(['name' => 'Менеджер', 'slug' => 'manager']);
		$adminRole = Role::create(['name' => 'Администратор', 'slug' => 'admin']);

		//admin user
		$admin = User::factory()
			->for($adminRole)
			->has(Article::factory()->count(2))
			->has(Page::factory()->count(2))
			->has(Image::factory()->count(3))
			->has(SpecialOffer::factory())
			->create();

		$themes = Theme::getDefaultThemes();
		foreach ($themes as $theme) {
			$filePath = public_path(sprintf("%s/%s", 'defaultThemesBackgrounds', $theme['background']));
			$file = new UploadedFile(
				$filePath,
				$theme['background'],
			);

			$properties = Theme::getPropertiesAliases();
			foreach ($theme['properties'] as $propertyKey => $propertyValue) {
				$properties[$propertyKey]['value'] = $propertyValue;
			}

			$data = [
				'name' => $theme['name'],
				'properties' => $properties,
			];

			$data['background'] = UploadService::upload($file, 'themesBackgrounds');
			$data['background_thumb'] = UploadService::uploadThumb($file, 'themesBackgrounds');

			$admin->themes()->create($data);
		}

		// manager user
		$manager = User::factory()
			->for($managerRole)
			->has(Article::factory()->count(2))
			->has(Page::factory()->count(2))
			->has(Image::factory()->count(3))
			->has(SpecialOffer::factory())
			->create();

		// agent users
		$agent = User::factory()
			->for($agentRole)
			->has(Article::factory()->count(2))
			->has(Page::factory()->count(2))
			->has(Image::factory()->count(3))
			->has(SpecialOffer::factory())
			->create();
	}
}
