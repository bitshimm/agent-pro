<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialOffer>
 */
class SpecialOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paragraphs = fake()->paragraphs(rand(6, 30));
        $title = fake()->realText(30);
        $content = "";
        foreach ($paragraphs as $paragraph) {
            $content .= "<p>$paragraph</p>";
        }
        $url = fake()->imageUrl();
        return [
            'title' => $title,
            'content' => $content,
            'image' => $url,
            'image_thumb' => $url,
            'sort' => 100,
            'active' => fake()->boolean(),
        ];
    }
}
