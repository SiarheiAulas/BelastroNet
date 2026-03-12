<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'url'=> fake()->unique()->url(),
            'title_ru'=> fake()->sentence(),
            'description_ru' => fake()->paragraph(),
            'title_by'=> fake()->sentence(),
            'description_by' => fake()->paragraph(),
            'title_en'=> fake()->sentence(),
            'description_en' => fake()->paragraph()
        ];
    }
}
