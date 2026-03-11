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
            'title'=> fake()->sentence(),
            'url'=> fake()->unique()->url(),
            'description' => fake()->paragraph()
        ];
    }
}
