<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['landscapes','sun_and_moon','solar_system','deepsky','sat','misc']),
            'author_id' => User::factory(),
            'title' => fake()->sentence(),
            'storage_link' => '/storage/documents/' . fake()->uuid() . fake()->randomElement(['.jpg','.png','bmp']),
            'description' => fake()->paragraph()
        ];
    }
}
