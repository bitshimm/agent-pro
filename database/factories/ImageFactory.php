<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $url = fake()->imageUrl();
        return [
            'path_full' => $url,
            'path_thumb' => $url,
            'alt' => fake()->realText(20),
            'caption' => fake()->realText(20),
            'sort' => fake()->randomNumber(),
            'active' => fake()->boolean(),
        ];
    }
}
