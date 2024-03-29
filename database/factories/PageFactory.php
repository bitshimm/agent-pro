<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paragraphs = fake()->paragraphs(rand(6, 100));
        $title = fake()->realText(30);
        $content = "";
        foreach ($paragraphs as $paragraph) {
            $content .= "<p>$paragraph</p>";
        }
        return [
            'title' => $title,
            'content' => $content,
            'sort' => 100,
            'active' => fake()->boolean(),
        ];
    }
}
