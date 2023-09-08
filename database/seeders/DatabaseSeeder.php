<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Image;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SocialNetwork;
use App\Models\SpecialOffer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		DB::table('social_networks')->insert(['name' => 'Telegram', 'icon' => '<i class="fa-brands fa-telegram"></i>']);
		DB::table('social_networks')->insert(['name' => 'Вконтакте', 'icon' => '<i class="fa-brands fa-vk"></i>']);
		DB::table('social_networks')->insert(['name' => 'Одноклассники', 'icon' => '<i class="fa-brands fa-square-odnoklassniki"></i>']);

		$agentRole = Role::create(['name' => 'Агент', 'slug' => 'agent']);
		$managerRole = Role::create(['name' => 'Менеджер', 'slug' => 'manager']);
		$adminRole = Role::create(['name' => 'Администратор', 'slug' => 'admin']);

		//admin user
		User::factory()
			->for($adminRole)
			->has(Article::factory()->count(5))
			->has(Page::factory()->count(5))
			->has(Image::factory()->count(10))
			->has(SpecialOffer::factory()->count(3))
			->create();

		// manager user
		User::factory()
			->for($managerRole)
			->has(Article::factory()->count(5))
			->has(Page::factory()->count(5))
			->has(Image::factory()->count(10))
			->has(SpecialOffer::factory()->count(3))
			->create();

		// agent users
		User::factory()
			->for($agentRole)
			->has(Article::factory()->count(5))
			->has(Page::factory()->count(5))
			->has(Image::factory()->count(10))
			->has(SpecialOffer::factory()->count(3))
			->count(3)->create();
	}
}
