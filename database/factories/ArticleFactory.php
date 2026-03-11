<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['workshop','tricks','observations','recommendations','photo_and_video','astronews','misc']),
            'title' =>fake()->sentence(),
            'author_id' => User::factory(),
            'slug' => fake()->unique()->slug,
            'text' => fake()->paragraph()
        ];
    }
}