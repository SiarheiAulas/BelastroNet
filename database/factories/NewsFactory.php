<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'slug' => fake()->unique()->slug,
            'title_ru' => fake()->sentence(),
            'text_ru'=> fake()->paragraph(),
            'title_by' => fake()->sentence(),
            'text_by'=> fake()->paragraph(),
            'title_en' => fake()->sentence(),
            'text_en'=> fake()->paragraph()
        ];
    }
}
