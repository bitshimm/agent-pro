<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\SocialNetwork;
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
        User::factory()
            ->has(Article::factory()->count(5))
            ->create();
    }
}
