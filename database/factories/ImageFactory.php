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
        return [
            'path_full' => fake()->imageUrl(),
            'path_thumb' => fake()->imageUrl(),
            'alt' => fake()->realText(20),
            'caption' => fake()->realText(20),
            'sort' => fake()->randomNumber(),
            'visibility' => fake()->boolean(),
        ];
    }
}
